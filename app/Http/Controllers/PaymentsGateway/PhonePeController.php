<?php

namespace App\Http\Controllers\PaymentsGateway;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentsGateway\PhonePe;

class PhonePeController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'card_title' => 'required|string',
            'status' => 'required|string', // 'active' or 'inactive'
            'environment' => 'required|string', // 'sandbox' or 'production'
            'client_id' => 'required|string',
            'client_secret' => 'required|string',
        ]);

        $phonepe = PhonePe::firstOrNew(['keyword' => 'phonepe']);
        $phonepe->name = $validated['card_title'];
        $phonepe->keyword = 'phonepe';
        $phonepe->information = [
            'status' => $validated['status'],
            'environment' => $validated['environment'],
            'client_id' => $validated['client_id'],
            'client_secret' => $validated['client_secret'],
        ];
        $phonepe->save();

        return redirect()->back()->with('success', $validated['card_title'] . ' updated successfully.');
    }
}
