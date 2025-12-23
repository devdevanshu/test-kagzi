<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates purchases table - tracks completed purchases
     */
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('pricing_id')->nullable()->constrained()->onDelete('set null');
            $table->string('transaction_id')->unique();
            $table->string('payment_gateway'); // paypal, cashfree, etc.
            $table->string('payment_method'); // credit_card, paypal, upi, etc.
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('INR');
            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled', 'refunded'])->default('pending');
            $table->json('payment_data')->nullable(); // Gateway response data
            $table->json('user_details')->nullable(); // Guest user details if user_id is null
            $table->timestamps();
            
            // Indexes
            $table->index(['status', 'created_at']);
            $table->index(['product_id', 'status']);
            $table->index('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
