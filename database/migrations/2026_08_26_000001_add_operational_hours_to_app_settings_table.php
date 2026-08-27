<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->string('operational_days')->nullable()->default('Senin - Sabtu')->after('address');
            $table->string('operational_hours')->nullable()->default('08.00 - 16.00 WIB')->after('operational_days');
            $table->boolean('show_operational_hours')->default(true)->after('operational_hours');
        });
    }

    public function down(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->dropColumn(['operational_days', 'operational_hours', 'show_operational_hours']);
        });
    }
};
