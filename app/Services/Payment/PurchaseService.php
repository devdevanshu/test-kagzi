<?php

namespace App\Services\Payment;

use App\Models\Purchase;
use App\Models\Checkout;
use App\Models\User;
use App\Models\Product;
use App\Models\Pricing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseConfirmation;

class PurchaseService
{
    /**
     * Create a purchase record from checkout
     */
    public function createPurchase(Checkout $checkout, array $paymentData = []): Purchase
    {
        try {
            DB::beginTransaction();

            // Get or create user if email is provided
            $user = null;
            if ($checkout->email) {
                $user = User::where('email', $checkout->email)->first();
                
                // Create guest user if not exists
                if (!$user) {
                    $user = User::create([
                        'name' => $checkout->name,
                        'email' => $checkout->email,
                        'phone' => $checkout->phone_number,
                        'password' => bcrypt('guest_' . time()), // Temporary password
                        'is_guest' => true, // Add this field to track guest users
                    ]);
                }
            }

            // Get product and pricing
            $product = Product::findOrFail($checkout->product_id);
            $pricing = Pricing::findOrFail($checkout->plan_id);

            // Create purchase record
            $purchase = Purchase::create([
                'user_id' => $user ? $user->id : null,
                'product_id' => $checkout->product_id,
                'pricing_id' => $checkout->plan_id,
                'transaction_id' => $checkout->transaction_id ?? $checkout->order_id,
                'payment_gateway' => $checkout->payment_method,
                'payment_method' => $this->determinePaymentMethod($checkout->payment_method),
                'amount' => $pricing->price,
                'currency' => $pricing->region === 'I' ? 'USD' : 'INR',
                'status' => 'pending',
                'payment_data' => $paymentData,
                'user_details' => $user ? null : [
                    'name' => $checkout->name,
                    'email' => $checkout->email,
                    'phone' => $checkout->phone_number,
                    'ip_address' => $checkout->ip_address,
                    'user_agent' => $checkout->user_agent,
                ],
            ]);

            DB::commit();

            Log::info('Purchase record created', [
                'purchase_id' => $purchase->id,
                'checkout_id' => $checkout->id,
                'user_id' => $user ? $user->id : 'guest',
                'amount' => $purchase->amount,
            ]);

            return $purchase;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create purchase record', [
                'checkout_id' => $checkout->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Update purchase status
     */
    public function updatePurchaseStatus(Purchase $purchase, string $status, array $paymentData = []): bool
    {
        try {
            $validStatuses = ['pending', 'completed', 'failed', 'cancelled', 'refunded'];
            
            if (!in_array($status, $validStatuses)) {
                throw new \InvalidArgumentException("Invalid status: {$status}");
            }

            $purchase->update([
                'status' => $status,
                'payment_data' => array_merge($purchase->payment_data ?? [], $paymentData),
                'updated_at' => now(),
            ]);

            Log::info('Purchase status updated', [
                'purchase_id' => $purchase->id,
                'old_status' => $purchase->getOriginal('status'),
                'new_status' => $status,
                'transaction_id' => $purchase->transaction_id,
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('Failed to update purchase status', [
                'purchase_id' => $purchase->id,
                'status' => $status,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Mark purchase as successful
     */
    public function markAsSuccessful(Purchase $purchase, array $paymentData = []): bool
    {
        $result = $this->updatePurchaseStatus($purchase, 'completed', $paymentData);
        
        if ($result) {
            // Create subscription record for successful purchase
            $this->createSubscriptionRecord($purchase, $paymentData);
            
            // Send purchase confirmation email
            $this->sendPurchaseConfirmationEmail($purchase);
        }
        
        return $result;
    }

    /**
     * Mark purchase as failed
     */
    public function markAsFailed(Purchase $purchase, array $paymentData = []): bool
    {
        return $this->updatePurchaseStatus($purchase, 'failed', $paymentData);
    }

    /**
     * Find purchase by transaction ID
     */
    public function findByTransactionId(string $transactionId): ?Purchase
    {
        return Purchase::where('transaction_id', $transactionId)
                      ->with(['user', 'product', 'pricing'])
                      ->first();
    }

    /**
     * Find purchase by checkout
     */
    public function findByCheckout(Checkout $checkout): ?Purchase
    {
        return Purchase::where('transaction_id', $checkout->transaction_id)
                      ->orWhere('transaction_id', $checkout->order_id)
                      ->with(['user', 'product', 'pricing'])
                      ->first();
    }

    /**
     * Determine payment method based on gateway
     */
    private function determinePaymentMethod(string $gateway): string
    {
        $methodMap = [
            'paypal' => 'paypal',
            'stripe' => 'credit_card',
            'cashfree' => 'upi',
            'phonepe' => 'upi',
            'easebuzz' => 'netbanking',
            'payu' => 'netbanking',
        ];

        return $methodMap[strtolower($gateway)] ?? 'other';
    }

    /**
     * Get user purchases
     */
    public function getUserPurchases(User $user, int $perPage = 10)
    {
        return Purchase::where('user_id', $user->id)
                      ->with(['product', 'pricing'])
                      ->orderBy('created_at', 'desc')
                      ->paginate($perPage);
    }

    /**
     * Get purchase statistics
     */
    public function getPurchaseStats(): array
    {
        return [
            'total_purchases' => Purchase::count(),
            'successful_purchases' => Purchase::where('status', 'completed')->count(),
            'failed_purchases' => Purchase::where('status', 'failed')->count(),
            'pending_purchases' => Purchase::where('status', 'pending')->count(),
            'total_revenue' => Purchase::where('status', 'completed')->sum('amount'),
            'today_purchases' => Purchase::whereDate('created_at', today())->count(),
            'this_month_purchases' => Purchase::whereMonth('created_at', now()->month)
                                           ->whereYear('created_at', now()->year)
                                           ->count(),
        ];
    }

    /**
     * Create subscription record for successful purchase
     */
    private function createSubscriptionRecord(Purchase $purchase, array $paymentData = []): bool
    {
        try {
            // Check if subscription already exists to prevent duplicates
            $existingSubscription = DB::table('subscriptions')
                                      ->where('transaction_id', $purchase->transaction_id)
                                      ->first();
            
            if ($existingSubscription) {
                Log::info('Subscription already exists', [
                    'transaction_id' => $purchase->transaction_id,
                    'subscription_id' => $existingSubscription->id
                ]);
                return true;
            }

            // Get customer details
            $customerName = $purchase->user ? $purchase->user->name : ($purchase->user_details['name'] ?? 'Guest');
            $customerEmail = $purchase->user ? $purchase->user->email : ($purchase->user_details['email'] ?? '');
            $customerPhone = $purchase->user ? $purchase->user->phone : ($purchase->user_details['phone'] ?? '');

            // Create subscription record
            $subscriptionData = [
                'product_id' => $purchase->product_id,
                'plan_id' => $purchase->pricing_id,
                'name' => $customerName,
                'email' => $customerEmail,
                'phone_number' => $customerPhone,
                'payment_method' => $purchase->payment_gateway,
                'purchase_date' => $purchase->created_at,
                'ip_address' => $purchase->user_details['ip_address'] ?? null,
                'user_agent' => $purchase->user_details['user_agent'] ?? null,
                'status' => 'Active', // Map completed purchase to Active subscription
                'transaction_id' => $purchase->transaction_id,
                'order_id' => $purchase->transaction_id, // Use same as transaction_id for consistency
                'pmt_response' => json_encode($paymentData),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('subscriptions')->insert($subscriptionData);

            Log::info('Subscription record created', [
                'purchase_id' => $purchase->id,
                'transaction_id' => $purchase->transaction_id,
                'customer_email' => $customerEmail,
                'product_id' => $purchase->product_id,
                'plan_id' => $purchase->pricing_id,
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('Failed to create subscription record', [
                'purchase_id' => $purchase->id,
                'transaction_id' => $purchase->transaction_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    /**
     * Send purchase confirmation email
     */
    private function sendPurchaseConfirmationEmail(Purchase $purchase)
    {
        try {
            // Load relationships if not already loaded
            $purchase->load(['user', 'product', 'pricing']);

            // Get customer email using the accessor
            $customerEmail = $purchase->customer_email;
            
            if (!$customerEmail) {
                Log::warning('No email address for purchase confirmation', [
                    'purchase_id' => $purchase->id,
                    'transaction_id' => $purchase->transaction_id
                ]);
                return;
            }

            // Send email
            Mail::to($customerEmail)->send(new PurchaseConfirmation($purchase));

            Log::info('Purchase confirmation email sent', [
                'purchase_id' => $purchase->id,
                'transaction_id' => $purchase->transaction_id,
                'customer_email' => $customerEmail,
                'customer_name' => $purchase->customer_name,
                'product_name' => $purchase->product->name ?? 'Unknown',
                'plan_name' => $purchase->pricing->name ?? 'Unknown',
                'amount' => $purchase->amount,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send purchase confirmation email', [
                'purchase_id' => $purchase->id,
                'transaction_id' => $purchase->transaction_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
