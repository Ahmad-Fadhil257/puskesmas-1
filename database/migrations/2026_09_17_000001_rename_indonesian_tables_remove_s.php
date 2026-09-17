<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('dokters') && !Schema::hasTable('dokter')) {
            Schema::rename('dokters', 'dokter');
        }

        if (Schema::hasTable('layanans') && !Schema::hasTable('layanan')) {
            Schema::rename('layanans', 'layanan');
        }

        if (Schema::hasTable('mitras') && !Schema::hasTable('mitra')) {
            Schema::rename('mitras', 'mitra');
        }

        if (Schema::hasTable('nilai_sections') && !Schema::hasTable('nilai_section')) {
            Schema::rename('nilai_sections', 'nilai_section');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('dokter') && !Schema::hasTable('dokters')) {
            Schema::rename('dokter', 'dokters');
        }

        if (Schema::hasTable('layanan') && !Schema::hasTable('layanans')) {
            Schema::rename('layanan', 'layanans');
        }

        if (Schema::hasTable('mitra') && !Schema::hasTable('mitras')) {
            Schema::rename('mitra', 'mitras');
        }

        if (Schema::hasTable('nilai_section') && !Schema::hasTable('nilai_sections')) {
            Schema::rename('nilai_section', 'nilai_sections');
        }
    }
};
