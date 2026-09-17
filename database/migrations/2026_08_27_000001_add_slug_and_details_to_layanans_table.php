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
        Schema::table('layanan', function (Blueprint $table) {
            if (!Schema::hasColumn('layanan', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('title');
            }
            if (!Schema::hasColumn('layanan', 'image')) {
                $table->string('image')->nullable()->after('description');
            }
            if (!Schema::hasColumn('layanan', 'jadwal_pendaftaran')) {
                $table->text('jadwal_pendaftaran')->nullable()->after('jam_operasional');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('layanan', function (Blueprint $table) {
            $table->dropColumn(['slug', 'image', 'jadwal_pendaftaran']);
        });
    }
};
