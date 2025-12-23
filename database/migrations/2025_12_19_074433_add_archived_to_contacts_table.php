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
        // Check if contacts table exists first
        if (Schema::hasTable('contacts')) {
            Schema::table('contacts', function (Blueprint $table) {
                if (!Schema::hasColumn('contacts', 'archived')) {
                    $table->boolean('archived')->default(false)->after('ip_address');
                }
            });
        } else {
            // Create contacts table if it doesn't exist
            Schema::create('contacts', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('phone')->nullable();
                $table->string('subject')->nullable();
                $table->text('message');
                $table->string('ip_address')->nullable();
                $table->boolean('archived')->default(false);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('contacts') && Schema::hasColumn('contacts', 'archived')) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->dropColumn('archived');
            });
        }
    }
};
