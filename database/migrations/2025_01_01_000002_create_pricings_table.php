<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates pricings table for product plans
     */
    public function up(): void
    {
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->enum('region', ['I', 'D'])->default('D'); // I=International(USD), D=Domestic(INR)
            $table->string('title');
            $table->decimal('price', 10, 2);
            $table->string('type')->default('unit'); // unit or credit
            $table->integer('type_value')->nullable(); // credit value (nullable - not all plans need credits)
            $table->integer('position')->default(0); // for ordering plans
            $table->timestamps();
            
            // Indexes
            $table->index('product_id');
            $table->index('region');
            $table->index('position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricings');
    }
};
