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
        Schema::create('b2c_api_response', function (Blueprint $table) {
            $table->id('b2bID');
            $table->string('TransactionReceipt', 15)->nullable();
            $table->string('TransactionAmount', 10)->nullable();
            $table->string('B2CWorkingAccountAvailableFunds', 10)->nullable();
            $table->string('B2CUtilityAccountAvailableFunds', 10)->nullable();
            $table->string('TransactionCompletedDateTime', 20)->nullable();
            $table->string('ReceiverPartyPublicName', 30)->nullable();
            $table->string('B2CChargesPaidAccountAvailableFunds', 10)->nullable();
            $table->string('B2CRecipientIsRegisteredCustomer', 2)->nullable();
            $table->timestamp('UpdatedTime')->nullable()->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b2c_api_response');
    }
};
