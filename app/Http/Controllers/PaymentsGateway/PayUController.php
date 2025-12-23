<?php

namespace App\Http\Controllers\PaymentsGateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentsGateway\PayU;

class PayUController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'card_title' => 'required|string',
            'status' => 'required|string', // 'active' or 'inactive'
            'environment' => 'required|string', // 'sandbox' or 'production'
            'client_id' => 'required|string',
            'client_secret' => 'required|string',
        ]);

        $payu = PayU::firstOrNew(['keyword' => 'payu']);
        $payu->name = $validated['card_title'];
        $payu->keyword = 'payu';
        $payu->information = [
            'status' => $validated['status'],
            'environment' => $validated['environment'],
            'client_id' => $validated['client_id'],
            'client_secret' => $validated['client_secret'],
        ];
        $payu->save();

        return redirect()->back()->with('success', $validated['card_title'] . ' updated successfully.');
    }
}

