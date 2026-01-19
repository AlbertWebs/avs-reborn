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
        Schema::create('reverse_transaction', function (Blueprint $table) {
            $table->id('transactionstatusID');
            $table->string('DebitAccountBalance', 25)->nullable();
            $table->string('Amount', 20)->nullable();
            $table->string('TransCompletedTime', 25)->nullable();
            $table->string('OriginalTransactionID', 20)->nullable();
            $table->string('Charge', 20)->nullable();
            $table->string('CreditPartyPublicName', 50)->nullable();
            $table->string('DebitPartyPublicName', 50)->nullable();
            $table->timestamp('updateTime')->nullable()->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reverse_transaction');
    }
};
