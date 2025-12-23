<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates products table
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->json('images')->nullable();
            $table->boolean('is_active')->default(true);
            
            // Product type fields
            $table->enum('product_type', ['credit', 'plan'])->default('plan');
            $table->integer('credit_value')->nullable();
            
            // SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            
            // Additional fields
            $table->string('project_url')->nullable();
            // $table->string('sku')->nullable(); // Commented out - not important
            
            $table->timestamps();
            
            // Indexes
            $table->index('slug');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
