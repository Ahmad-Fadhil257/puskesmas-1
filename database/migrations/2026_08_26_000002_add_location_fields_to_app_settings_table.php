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
            if (!Schema::hasColumn('app_settings', 'maps_iframe_url')) {
                $table->text('maps_iframe_url')->nullable()->after('address');
            }
            if (!Schema::hasColumn('app_settings', 'maps_link')) {
                $table->string('maps_link')->nullable()->after('maps_iframe_url');
            }
            if (!Schema::hasColumn('app_settings', 'emergency_info')) {
                $table->string('emergency_info')->nullable()->default('24 Jam Setiap Hari')->after('operational_hours');
            }
            if (!Schema::hasColumn('app_settings', 'landmark')) {
                $table->string('landmark')->nullable()->after('address');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->dropColumn(['maps_iframe_url', 'maps_link', 'emergency_info', 'landmark']);
        });
    }
};
