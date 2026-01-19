<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('category', function (Blueprint $table) {
            if (!Schema::hasColumn('category', 'order')) {
                $table->integer('order')->default(0)->after('id');
            }
            if (!Schema::hasColumn('category', 'home')) {
                $table->boolean('home')->default(0)->after('order');
            }
        });
        
        // Set initial order values based on existing IDs
        DB::statement('UPDATE category SET `order` = id WHERE `order` = 0 OR `order` IS NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category', function (Blueprint $table) {
            $table->dropColumn(['order', 'home']);
        });
    }
};
