<?php

namespace App\Http\Controllers\PaymentsGateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentsGateway\Cashfree;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CashfreeController extends BaseGatewayController
{
    /**
     * Show the form for editing Cashfree settings.
     */
    public function edit()
    {
        $cashfree = Cashfree::where('keyword', 'cashfree')->first();
        return view('payments.gateways.cashfree', compact('cashfree'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'card_title' => 'required|string|max:255',
                'status' => 'required|in:active,inactive',
                'environment' => 'required|in:sandbox,production',
                'app_id' => 'required|string|max:255',
                'secret_key' => 'required|string|max:255',
            ]);
            
            // Debug log to check what's being submitted
            Log::info('Cashfree form submission', [
                'status' => $validated['status'] ?? 'missing',
                'all_input' => $request->all(),
                'validated' => $validated
            ]);

            // Use base controller method for consistent handling
            $this->updateGatewayConfig('cashfree', $validated, 'status', ['secret_key']);

            $isActive = $validated['status'] === 'active';
            
            // Verify the update was successful
            $updated = DB::table('payment_gateways')->where('keyword', 'cashfree')->first();
            Log::info('Cashfree updated in database', [
                'is_active' => $updated->is_active ?? 'not found',
                'information' => $updated->information ?? 'not found'
            ]);

            return redirect()->back()->with('success', $validated['card_title'] . ' updated successfully. Status: ' . ($isActive ? 'Active' : 'Inactive'));
            
        } catch (\Exception $e) {
            Log::error('Cashfree update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);
            return redirect()->back()->withErrors(['error' => 'Failed to update Cashfree settings: ' . $e->getMessage()]);
        }
    }

    /**
     * Test Cashfree gateway configuration
     */
    public function test(Request $request)
    {
        $result = $this->testGatewayConfig('cashfree', ['client_id', 'client_secret', 'environment']);
        return response()->json($result);
    }
}
