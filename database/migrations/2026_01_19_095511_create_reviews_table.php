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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('name')->nullable();
            $table->string('author')->nullable();
            $table->string('email')->nullable();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->integer('rating')->default(5); // 1-5 star rating
            $table->integer('liked')->default(0); // helpful count
            $table->integer('unlike')->default(0); // unhelpful count
            $table->tinyInteger('status')->default(0); // 0 = unapproved, 1 = approved
            $table->timestamps();
            
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->index('product_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
