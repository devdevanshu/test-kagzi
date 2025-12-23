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
        // Only add indexes if tables exist (they might be in JobAway project)
        if (Schema::hasTable('purchases')) {
            Schema::table('purchases', function (Blueprint $table) {
                // Add indexes for better query performance
                if (!$this->indexExists('purchases', 'idx_purchases_status_created')) {
                    $table->index(['status', 'created_at'], 'idx_purchases_status_created');
                }
                if (!$this->indexExists('purchases', 'idx_purchases_user_created')) {
                    $table->index(['user_id', 'created_at'], 'idx_purchases_user_created');
                }
                if (!$this->indexExists('purchases', 'idx_purchases_gateway')) {
                    $table->index(['payment_gateway'], 'idx_purchases_gateway');
                }
                if (!$this->indexExists('purchases', 'idx_purchases_transaction')) {
                    $table->index(['transaction_id'], 'idx_purchases_transaction');
                }
            });
        }
        
        if (Schema::hasTable('payment_gateways')) {
            Schema::table('payment_gateways', function (Blueprint $table) {
                // Add index for payment gateway queries
                if (!$this->indexExists('payment_gateways', 'idx_payment_gateways_active_keyword')) {
                    $table->index(['is_active', 'keyword'], 'idx_payment_gateways_active_keyword');
                }
            });
        }
    }

    /**
     * Check if an index exists on a table
     */
    private function indexExists($table, $index)
    {
        $connection = Schema::getConnection();
        $database = $connection->getDatabaseName();
        
        $result = $connection->select(
            "SELECT COUNT(*) as count FROM information_schema.statistics 
             WHERE table_schema = ? AND table_name = ? AND index_name = ?",
            [$database, $table, $index]
        );
        
        return $result[0]->count > 0;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('purchases')) {
            Schema::table('purchases', function (Blueprint $table) {
                if ($this->indexExists('purchases', 'idx_purchases_status_created')) {
                    $table->dropIndex('idx_purchases_status_created');
                }
                if ($this->indexExists('purchases', 'idx_purchases_user_created')) {
                    $table->dropIndex('idx_purchases_user_created');
                }
                if ($this->indexExists('purchases', 'idx_purchases_gateway')) {
                    $table->dropIndex('idx_purchases_gateway');
                }
                if ($this->indexExists('purchases', 'idx_purchases_transaction')) {
                    $table->dropIndex('idx_purchases_transaction');
                }
            });
        }
        
        if (Schema::hasTable('payment_gateways')) {
            Schema::table('payment_gateways', function (Blueprint $table) {
                if ($this->indexExists('payment_gateways', 'idx_payment_gateways_active_keyword')) {
                    $table->dropIndex('idx_payment_gateways_active_keyword');
                }
            });
        }
    }
};