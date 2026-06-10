<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product', function (Blueprint $table) {
            if (!Schema::hasColumn('product', 'gallery_images')) {
                $table->text('gallery_images')->nullable()->after('image_three');
            }
        });
    }

    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            if (Schema::hasColumn('product', 'gallery_images')) {
                $table->dropColumn('gallery_images');
            }
        });
    }
};
