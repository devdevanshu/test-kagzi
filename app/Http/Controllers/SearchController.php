<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Subscription;
use App\Models\Purchase;
use App\Models\Product;

class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        $query = $request->input('q');
        
        // Require minimum 3 characters
        if (!$query || strlen($query) < 3) {
            return view('search.results', [
                'query' => $query ?? '',
                'users' => collect(),
                'contacts' => collect(),
                'subscriptions' => collect(),
                'purchases' => collect(),
            ]);
        }

        // Search Users
        $users = User::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->orWhere('phone', 'LIKE', "%{$query}%")
                    ->limit(10)
                    ->get();

        // Search Contacts
        $contacts = Contact::where('name', 'LIKE', "%{$query}%")
                          ->orWhere('email', 'LIKE', "%{$query}%")
                          ->orWhere('subject', 'LIKE', "%{$query}%")
                          ->limit(10)
                          ->get();

        // Search Subscriptions
        $subscriptions = Subscription::where('name', 'LIKE', "%{$query}%")
                                   ->orWhere('transaction_id', 'LIKE', "%{$query}%")
                                   ->with(['product', 'plan'])
                                   ->limit(10)
                                   ->get();

        // Search Purchases - Fixed to use correct columns
        $purchases = Purchase::where('transaction_id', 'LIKE', "%{$query}%")
                            ->orWhereHas('product', function($q) use ($query) {
                                $q->where('name', 'LIKE', "%{$query}%");
                            })
                            ->orWhereHas('user', function($q) use ($query) {
                                $q->where('name', 'LIKE', "%{$query}%");
                            })
                            ->orWhereJsonContains('user_details->name', $query)
                            ->with(['product', 'pricing', 'user'])
                            ->limit(10)
                            ->get();

        return view('search.results', compact('query', 'users', 'contacts', 'subscriptions', 'purchases'));
    }

    public function liveSearch(Request $request)
    {
        try {
            $query = $request->input('q');
            
            // Require minimum 3 characters
            if (!$query || strlen($query) < 3) {
                return response()->json([]);
            }

            $results = [];

            // Search Users
            $users = User::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('email', 'LIKE', "%{$query}%")
                        ->limit(5)
                        ->get(['id', 'name', 'email']);

            // Search Contacts
            $contacts = Contact::where('name', 'LIKE', "%{$query}%")
                              ->orWhere('email', 'LIKE', "%{$query}%")
                              ->limit(5)
                              ->get(['id', 'name', 'email', 'created_at']);

            // Search Subscriptions - Fixed to remove non-existent email column
            $subscriptions = Subscription::where('name', 'LIKE', "%{$query}%")
                                       ->orWhere('transaction_id', 'LIKE', "%{$query}%")
                                       ->limit(5)
                                       ->get(['id', 'name', 'transaction_id']);

            // Search Purchases - Fixed to use correct columns and relationships
            $purchases = Purchase::where('transaction_id', 'LIKE', "%{$query}%")
                                ->orWhereHas('product', function($q) use ($query) {
                                    $q->where('name', 'LIKE', "%{$query}%");
                                })
                                ->orWhereHas('user', function($q) use ($query) {
                                    $q->where('name', 'LIKE', "%{$query}%");
                                })
                                ->with(['product', 'user'])
                                ->limit(5)
                                ->get(['id', 'transaction_id', 'amount', 'product_id', 'user_id', 'user_details']);

            // Format User results
            foreach ($users as $user) {
                $results[] = [
                    'type' => 'user',
                    'id' => $user->id,
                    'title' => $user->name,
                    'subtitle' => $user->email,
                    'url' => route('users.show', $user->id),
                ];
            }

            // Format Contact results
            foreach ($contacts as $contact) {
                $results[] = [
                    'type' => 'contact',
                    'id' => $contact->id,
                    'title' => $contact->name,
                    'subtitle' => $contact->email,
                    'url' => route('contacts.show', $contact->id),
                ];
            }

            // Format Subscription results
            foreach ($subscriptions as $subscription) {
                $results[] = [
                    'type' => 'subscription',
                    'id' => $subscription->id,
                    'title' => $subscription->name,
                    'subtitle' => $subscription->transaction_id,
                    'url' => route('subscription.show', $subscription->id),
                ];
            }

            // Format Purchase results
            foreach ($purchases as $purchase) {
                // Safely get user name
                $userName = 'Guest';
                if ($purchase->user) {
                    $userName = $purchase->user->name;
                } elseif (is_array($purchase->user_details) && isset($purchase->user_details['name'])) {
                    $userName = $purchase->user_details['name'];
                }
                
                $productName = $purchase->product ? $purchase->product->name : 'Unknown Product';
                
                $results[] = [
                    'type' => 'purchase',
                    'id' => $purchase->id,
                    'title' => $purchase->transaction_id,
                    'subtitle' => "$userName - $productName",
                    'url' => route('subscription.show', $purchase->id),
                ];
            }

            return response()->json($results);
        } catch (\Exception $e) {
            // Log the error and return empty array
            \Log::error('Live search error', [
                'error' => $e->getMessage(),
                'query' => $request->input('q')
            ]);
            return response()->json([]);
        }
    }
}
