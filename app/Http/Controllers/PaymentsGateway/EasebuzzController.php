<?php

namespace App\Http\Controllers\PaymentsGateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentsGateway\Easebuzz;

class EasebuzzController extends Controller
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
            'key' => 'required|string',
            'salt' => 'required|string',
        ]);

        $easebuzz = Easebuzz::firstOrNew(['keyword' => 'easebuzz']);
        $easebuzz->name = $validated['card_title'];
        $easebuzz->keyword = 'easebuzz';
        $easebuzz->information = [
            'status' => $validated['status'],
            'environment' => $validated['environment'],
            'key' => $validated['key'],
            'salt' => $validated['salt'],
        ];
        $easebuzz->save();

        return redirect()->back()->with('success', $validated['card_title'] . ' updated successfully.');
    }
}
