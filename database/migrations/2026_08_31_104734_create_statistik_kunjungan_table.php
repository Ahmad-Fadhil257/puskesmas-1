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
        Schema::create('statistik_kunjungan', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->tinyInteger('bulan'); // 1-12
            $table->string('bulan_label'); // "Januari", "Februari", dst
            $table->unsignedInteger('jumlah_kunjungan')->default(0);
            $table->unsignedInteger('kunjungan_baru')->default(0);
            $table->unsignedInteger('kunjungan_lama')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik_kunjungan');
    }
};
