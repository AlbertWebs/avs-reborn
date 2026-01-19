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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slung')->nullable(); // slug for URL
            $table->string('code')->nullable();
            $table->text('content')->nullable();
            $table->text('meta')->nullable();
            $table->text('iframe')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('price_raw', 10, 2)->nullable();
            $table->string('brand')->nullable();
            $table->unsignedBigInteger('cat')->nullable(); // category ID
            $table->unsignedBigInteger('sub_cat')->nullable(); // subcategory ID
            $table->string('thumbnail')->nullable();
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_three')->nullable();
            $table->string('fb_pixels')->nullable();
            $table->string('google_product_category')->nullable();
            $table->tinyInteger('offer')->default(0); // 0 = no offer, 1 = on offer
            $table->timestamps();
            
            $table->foreign('cat')->references('id')->on('category')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
