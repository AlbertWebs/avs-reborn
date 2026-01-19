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
        Schema::table('invoices', function (Blueprint $table) {
            // Add number column (alias for invoice_number for backward compatibility)
            if (!Schema::hasColumn('invoices', 'number')) {
                $table->string('number')->nullable()->after('invoice_number');
            }
            // Add shipping column
            if (!Schema::hasColumn('invoices', 'shipping')) {
                $table->decimal('shipping', 10, 2)->nullable()->after('amount');
            }
            // Add products column (to store serialized cart items)
            if (!Schema::hasColumn('invoices', 'products')) {
                $table->text('products')->nullable()->after('shipping');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            if (Schema::hasColumn('invoices', 'number')) {
                $table->dropColumn('number');
            }
            if (Schema::hasColumn('invoices', 'shipping')) {
                $table->dropColumn('shipping');
            }
            if (Schema::hasColumn('invoices', 'products')) {
                $table->dropColumn('products');
            }
        });
    }
};
