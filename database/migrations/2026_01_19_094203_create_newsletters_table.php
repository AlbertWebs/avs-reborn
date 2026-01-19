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
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('user')->nullable(); // email or IP address
            $table->string('email')->nullable(); // email address for newsletter subscription
            $table->string('ip_address')->nullable(); // IP address
            $table->tinyInteger('status')->default(1); // 1 = active, 0 = unsubscribed
            $table->timestamps();
            
            $table->index('user');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
};
