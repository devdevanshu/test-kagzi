<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\PaymentsGateway\Paypal;
use App\Models\PaymentsGateway\Stripe;
use App\Models\PaymentsGateway\PayU;
use App\Models\PaymentsGateway\Easebuzz;
use App\Models\PaymentsGateway\Cashfree;
use App\Models\PaymentsGateway\PhonePe;

class PaymentGatewayController extends Controller
{
    public function index(){
        try {
            // Get only Cashfree and PayPal gateways from the unified payment_gateways table
            $gateways = DB::table('payment_gateways')
                          ->whereIn('keyword', ['cashfree', 'paypal'])
                          ->get()
                          ->keyBy('keyword');
            
            // Get individual gateway configurations
            $paypal = $gateways->get('paypal');
            $cashfree = $gateways->get('cashfree');
            
            // If gateways don't exist, create default entries
            if (!$paypal) {
                $paypal = (object)[
                    'id' => null,
                    'name' => 'PayPal',
                    'keyword' => 'paypal',
                    'information' => [
                        'status' => 'inactive',
                        'environment' => 'sandbox',
                        'client_id' => '',
                        'client_secret' => ''
                    ],
                    'is_active' => false
                ];
            } else {
                $paypal->information = json_decode($paypal->information, true) ?? [];
                // Ensure status in information matches is_active field
                $paypal->information['status'] = $paypal->is_active ? 'active' : 'inactive';
            }
            
            if (!$cashfree) {
                $cashfree = (object)[
                    'id' => null,
                    'name' => 'Cashfree',
                    'keyword' => 'cashfree',
                    'information' => [
                        'status' => 'inactive',
                        'environment' => 'sandbox',
                        'app_id' => '',
                        'secret_key' => ''
                    ],
                    'is_active' => false
                ];
            } else {
                $cashfree->information = json_decode($cashfree->information, true) ?? [];
                // Ensure status in information matches is_active field
                $cashfree->information['status'] = $cashfree->is_active ? 'active' : 'inactive';
            }
            
            // Debug log what we're sending to the view
            Log::info('Payment gateways loaded for view', [
                'paypal_active' => $paypal->is_active ?? 'not set',
                'paypal_status' => $paypal->information['status'] ?? 'not set',
                'cashfree_active' => $cashfree->is_active ?? 'not set',
                'cashfree_status' => $cashfree->information['status'] ?? 'not set'
            ]);
            
            return view('payments.index', compact('paypal', 'cashfree', 'gateways'));
        } catch (\Exception $e) {
            Log::error('Failed to load payment gateways', ['error' => $e->getMessage()]);
            
            return redirect()->back()->with('error', 'Failed to load payment gateway configurations.');
        }
    }

    /**
     * Update gateway status (enable/disable)
     */
    public function updateStatus(Request $request, $gateway)
    {
        try {
            $request->validate([
                'is_active' => 'required|boolean'
            ]);

            DB::table('payment_gateways')
              ->where('keyword', $gateway)
              ->update([
                  'is_active' => $request->is_active,
                  'updated_at' => now()
              ]);

            return response()->json([
                'success' => true,
                'message' => ucfirst($gateway) . ' gateway ' . ($request->is_active ? 'enabled' : 'disabled') . ' successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to update gateway status', [
                'gateway' => $gateway,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update gateway status.'
            ], 500);
        }
    }

    /**
     * Get gateway statistics
     */
    public function statistics()
    {
        try {
            $stats = [];
            
            // Get transaction counts by gateway from purchases table
            $gatewayStats = DB::table('purchases')
                             ->select('payment_gateway', DB::raw('COUNT(*) as total'), DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as successful'))
                             ->groupBy('payment_gateway')
                             ->get();

            foreach ($gatewayStats as $stat) {
                $stats[$stat->payment_gateway] = [
                    'total_transactions' => $stat->total,
                    'successful_transactions' => $stat->successful,
                    'success_rate' => $stat->total > 0 ? round(($stat->successful / $stat->total) * 100, 2) : 0
                ];
            }

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to get gateway statistics', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to get gateway statistics.'
            ], 500);
        }
    }
}
