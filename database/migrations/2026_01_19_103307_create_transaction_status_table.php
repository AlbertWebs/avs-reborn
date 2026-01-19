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
        Schema::create('transaction_status', function (Blueprint $table) {
            $table->id('transactionStatusID');
            $table->string('ReceiptNo', 20)->nullable();
            $table->string('ConversationID', 50)->nullable();
            $table->string('FinalisedTime', 25)->nullable();
            $table->string('Amount', 20)->nullable();
            $table->string('TransactionStatus', 20)->nullable();
            $table->string('ReasonType', 50)->nullable();
            $table->string('DebitPartyCharges', 20)->nullable();
            $table->string('DebitAccountType', 20)->nullable();
            $table->string('InitiatedTime', 20)->nullable();
            $table->string('OriginatorConversationID', 20)->nullable();
            $table->string('CreditPartyName', 55)->nullable();
            $table->string('DebitPartyName', 50)->nullable();
            $table->timestamp('updatedTime')->nullable()->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_status');
    }
};
