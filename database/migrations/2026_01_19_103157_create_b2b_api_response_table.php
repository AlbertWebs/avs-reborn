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
        Schema::create('b2b_api_response', function (Blueprint $table) {
            $table->id('b2bTransactionID');
            $table->string('TransactionID', 20)->nullable();
            $table->string('InitiatorAccountCurrentBalance', 20)->nullable();
            $table->string('DebitAccountCurrentBalance', 20)->nullable();
            $table->string('Amount', 20)->nullable();
            $table->string('DebitPartyAffectedAccountBalance', 20)->nullable();
            $table->string('TransCompletedTime', 20)->nullable();
            $table->string('DebitPartyCharges', 20)->nullable();
            $table->string('ReceiverPartyPublicName', 50)->nullable();
            $table->string('Currency', 20)->nullable();
            $table->timestamp('UpdatedTime')->nullable()->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b2b_api_response');
    }
};
