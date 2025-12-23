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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('pricings')->onDelete('cascade');
            $table->string('payment_method');
            $table->string('status')->default('pending'); // pending, completed, failed, cancelled
            $table->string('order_id')->unique();
            $table->string('transaction_id')->nullable();
            $table->json('payment_data')->nullable();
            $table->string('ip_address')->nullable();
            $table->longText('user_agent')->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index('email');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
