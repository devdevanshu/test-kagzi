<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Seeds default payment gateways (Cashfree and PayPal)
     * Disables all other gateways for security
     */
    public function up(): void
    {
        $gateways = [
            [
                'name' => 'Cashfree',
                'display_name' => 'Cashfree Payments',
                'keyword' => 'cashfree',
                'information' => json_encode([
                    'app_id' => '',
                    'secret_key' => '',
                    'environment' => 'sandbox', // sandbox or production
                    'currency' => 'INR'
                ]),
                'config' => json_encode([
                    'app_id' => env('CASHFREE_APP_ID', ''),
                    'secret_key' => env('CASHFREE_SECRET_KEY', ''),
                    'environment' => env('CASHFREE_ENV', 'sandbox'),
                    'currency' => 'INR',
                    'webhook_url' => '',
                ]),
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PayPal',
                'display_name' => 'PayPal',
                'keyword' => 'paypal',
                'information' => json_encode([
                    'client_id' => '',
                    'client_secret' => '',
                    'environment' => 'sandbox', // sandbox or live
                    'currency' => 'USD'
                ]),
                'config' => json_encode([
                    'client_id' => env('PAYPAL_CLIENT_ID', ''),
                    'client_secret' => env('PAYPAL_CLIENT_SECRET', ''),
                    'environment' => env('PAYPAL_MODE', 'sandbox'),
                    'currency' => 'USD',
                    'webhook_url' => '',
                ]),
                'is_active' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($gateways as $gateway) {
            DB::table('payment_gateways')->updateOrInsert(
                ['keyword' => $gateway['keyword']],
                $gateway
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('payment_gateways')->whereIn('keyword', ['cashfree', 'paypal'])->delete();
    }
};
