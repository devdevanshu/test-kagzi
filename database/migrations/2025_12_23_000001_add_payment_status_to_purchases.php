<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            // Add payment_status column if it doesn't exist
            if (!Schema::hasColumn('purchases', 'payment_status')) {
                $table->enum('payment_status', ['pending', 'processing', 'completed', 'failed', 'refunded'])->nullable()->after('payment_method');
            }
            
            // Add admin_notes column if it doesn't exist
            if (!Schema::hasColumn('purchases', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('payment_data');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            if (Schema::hasColumn('purchases', 'payment_status')) {
                $table->dropColumn('payment_status');
            }
            if (Schema::hasColumn('purchases', 'admin_notes')) {
                $table->dropColumn('admin_notes');
            }
        });
    }
};
