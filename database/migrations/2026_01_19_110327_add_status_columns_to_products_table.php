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
        Schema::table('product', function (Blueprint $table) {
            if (!Schema::hasColumn('product', 'featured')) {
                $table->tinyInteger('featured')->default(0)->after('offer'); // 0 = not featured, 1 = featured
            }
            if (!Schema::hasColumn('product', 'slider')) {
                $table->tinyInteger('slider')->default(0)->after('featured'); // 0 = not in slider, 1 = in slider
            }
            if (!Schema::hasColumn('product', 'trending')) {
                $table->tinyInteger('trending')->default(0)->after('slider'); // 0 = not trending, 1 = trending
            }
            if (!Schema::hasColumn('product', 'full')) {
                $table->tinyInteger('full')->default(0)->after('trending'); // 0 = not full, 1 = full
            }
            if (!Schema::hasColumn('product', 'banner')) {
                $table->tinyInteger('banner')->default(0)->after('full'); // 0 = not banner, 1 = banner
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->tinyInteger('featured')->default(0)->after('offer'); // 0 = not featured, 1 = featured
            $table->tinyInteger('slider')->default(0)->after('featured'); // 0 = not in slider, 1 = in slider
            $table->tinyInteger('trending')->default(0)->after('slider'); // 0 = not trending, 1 = trending
            $table->tinyInteger('full')->default(0)->after('trending'); // 0 = not full, 1 = full
            $table->tinyInteger('banner')->default(0)->after('full'); // 0 = not banner, 1 = banner
        });
    }
};
