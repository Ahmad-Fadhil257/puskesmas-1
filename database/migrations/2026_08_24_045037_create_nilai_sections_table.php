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
        Schema::create('nilai_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('NILAI - NILAI KAMI');
            $table->text('title');
            $table->string('logo_1')->nullable();
            $table->string('logo_1_name')->nullable()->default('BPJS Kesehatan');
            $table->string('logo_2')->nullable();
            $table->string('logo_2_name')->nullable()->default('Kementerian Kesehatan Republik Indonesia');
            $table->string('logo_3')->nullable();
            $table->string('logo_3_name')->nullable()->default('Mitra Kesehatan Puskesmas');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_sections');
    }
};
