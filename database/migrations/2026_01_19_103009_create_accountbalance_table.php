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
        Schema::create('accountbalance', function (Blueprint $table) {
            $table->id('accountBalID');
            $table->string('WorkingAccount', 20)->nullable();
            $table->string('FloatAccount', 20)->nullable();
            $table->string('UtilityAccount', 20)->nullable();
            $table->string('ChargesPaidAccount', 20)->nullable();
            $table->string('OrganizationSettlementAccount', 20)->nullable();
            $table->string('BOCompletedTime', 50)->nullable();
            $table->timestamp('updatedTime')->nullable()->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accountbalance');
    }
};
