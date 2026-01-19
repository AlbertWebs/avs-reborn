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
        Schema::table('sitesettings', function (Blueprint $table) {
            $table->string('mobile_one_display')->nullable()->after('mobile_one');
            $table->string('mobile_two_display')->nullable()->after('mobile_two');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sitesettings', function (Blueprint $table) {
            $table->dropColumn(['mobile_one_display', 'mobile_two_display']);
        });
    }
};
