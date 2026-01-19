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
        Schema::table('seosettings', function (Blueprint $table) {
            if (!Schema::hasColumn('seosettings', 'tagline')) {
                $table->string('tagline')->nullable()->after('intro');
            }
            if (!Schema::hasColumn('seosettings', 'location')) {
                $table->string('location')->nullable()->after('url');
            }
            if (!Schema::hasColumn('seosettings', 'address')) {
                $table->text('address')->nullable()->after('location');
            }
            if (!Schema::hasColumn('seosettings', 'facebook')) {
                $table->string('facebook')->nullable()->after('address');
            }
            if (!Schema::hasColumn('seosettings', 'twitter')) {
                $table->string('twitter')->nullable()->after('facebook');
            }
            if (!Schema::hasColumn('seosettings', 'linkedin')) {
                $table->string('linkedin')->nullable()->after('twitter');
            }
            if (!Schema::hasColumn('seosettings', 'instagram')) {
                $table->string('instagram')->nullable()->after('linkedin');
            }
            if (!Schema::hasColumn('seosettings', 'youtube')) {
                $table->string('youtube')->nullable()->after('instagram');
            }
            if (!Schema::hasColumn('seosettings', 'google')) {
                $table->string('google')->nullable()->after('youtube');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seosettings', function (Blueprint $table) {
            $table->dropColumn([
                'tagline',
                'location',
                'address',
                'facebook',
                'twitter',
                'linkedin',
                'instagram',
                'youtube',
                'google'
            ]);
        });
    }
};
