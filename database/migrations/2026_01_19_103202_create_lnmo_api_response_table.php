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
        Schema::create('lnmo_api_response', function (Blueprint $table) {
            $table->id('lnmoID');
            $table->string('Amount', 20)->nullable();
            $table->string('MpesaReceiptNumber', 20)->nullable();
            $table->string('TransactionDate', 20)->nullable();
            $table->string('PhoneNumber', 15)->nullable();
            $table->timestamp('updateTime')->nullable()->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lnmo_api_response');
    }
};
