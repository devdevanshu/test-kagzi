<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    /**
     * Get all active payment gateways
     */
    public function index()
    {
        try {
            $gateways = PaymentGateway::where('is_active', true)
                ->orderBy('name')
                ->get(['id', 'name', 'description', 'is_active']);

            return response()->json([
                'success' => true,
                'data' => $gateways,
                'message' => 'Payment gateways retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve payment gateways',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}



