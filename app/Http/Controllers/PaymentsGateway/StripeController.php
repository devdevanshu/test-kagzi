<?php

namespace App\Http\Controllers\PaymentsGateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentsGateway\Stripe;

class StripeController extends Controller{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'card_title' => 'required|string',
            'status' => 'required|string', // 'active' or 'inactive'
            'environment' => 'required|string', // 'sandbox' or 'production'
            'public_key' => 'required|string',
            'secret_key' => 'required|string',
        ]);

        $stripe = Stripe::firstOrNew(['keyword' => 'stripe']);
        $stripe->name = $validated['card_title'];
        $stripe->keyword = 'stripe';
        $stripe->information = [
            'status' => $validated['status'],
            'environment' => $validated['environment'],
            'public_key' => $validated['public_key'],
            'secret_key' => $validated['secret_key'],
        ];
        $stripe->save();

        return redirect()->back()->with('success', $validated['card_title'] . ' updated successfully.');
    }
}
