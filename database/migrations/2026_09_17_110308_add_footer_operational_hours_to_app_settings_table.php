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
            $table->string('footer_weekday_days')->nullable()->default('Senin - Jumat');
            $table->string('footer_weekday_hours')->nullable()->default('07.30 - 16.00 WIB');
            $table->string('footer_weekend_days')->nullable()->default('Sabtu');
            $table->string('footer_weekend_hours')->nullable()->default('07.30 - 12.00 WIB');
            $table->string('footer_closed_info')->nullable()->default('Minggu & Libur: Tutup');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->dropColumn([
                'footer_weekday_days',
                'footer_weekday_hours',
                'footer_weekend_days',
                'footer_weekend_hours',
                'footer_closed_info'
            ]);
        });
    }
};
