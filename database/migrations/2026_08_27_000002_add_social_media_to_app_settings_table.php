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
        Schema::table('app_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('app_settings', 'facebook_link')) {
                $table->string('facebook_link')->nullable()->after('address');
            }
            if (!Schema::hasColumn('app_settings', 'instagram_link')) {
                $table->string('instagram_link')->nullable()->after('facebook_link');
            }
            if (!Schema::hasColumn('app_settings', 'twitter_link')) {
                $table->string('twitter_link')->nullable()->after('instagram_link');
            }
            if (!Schema::hasColumn('app_settings', 'youtube_link')) {
                $table->string('youtube_link')->nullable()->after('twitter_link');
            }
            if (!Schema::hasColumn('app_settings', 'tiktok_link')) {
                $table->string('tiktok_link')->nullable()->after('youtube_link');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->dropColumn([
                'facebook_link',
                'instagram_link',
                'twitter_link',
                'youtube_link',
                'tiktok_link',
            ]);
        });
    }
};
