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
        Schema::create('statistik_penyakit', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penyakit');
            $table->unsignedInteger('jumlah_kasus')->default(0);
            $table->string('kode_icd')->nullable();
            $table->string('warna')->nullable(); // HEX color for chart
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->year('tahun');
            $table->tinyInteger('bulan')->nullable(); // null = tahunan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik_penyakit');
    }
};
