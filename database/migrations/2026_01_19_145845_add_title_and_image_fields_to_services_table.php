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
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'title')) {
                $table->string('title')->nullable()->after('name');
            }
            if (!Schema::hasColumn('services', 'image_two')) {
                $table->string('image_two')->nullable()->after('image_one');
            }
            if (!Schema::hasColumn('services', 'image_three')) {
                $table->string('image_three')->nullable()->after('image_two');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['title', 'image_two', 'image_three']);
        });
    }
};
