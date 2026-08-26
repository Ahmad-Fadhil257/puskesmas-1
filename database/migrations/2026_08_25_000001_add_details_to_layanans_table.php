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
        Schema::table('layanans', function (Blueprint $table) {
            $table->string('jam_operasional')->nullable()->after('variant')->default('Senin - Sabtu: 08.00 - 14.00 WIB');
            $table->json('dokter_ids')->nullable()->after('jam_operasional');
            $table->text('tindakan_medis')->nullable()->after('dokter_ids');
            $table->text('persyaratan')->nullable()->after('tindakan_medis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->dropColumn(['jam_operasional', 'dokter_ids', 'tindakan_medis', 'persyaratan']);
        });
    }
};
