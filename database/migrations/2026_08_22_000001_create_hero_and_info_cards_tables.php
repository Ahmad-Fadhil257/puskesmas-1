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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('Selamat Datang Di Puskesmas CareLink');
            $table->string('title')->default('Melayani Kesehatan Masyarakat dengan Sepenuh Hati');
            $table->text('description')->nullable();
            $table->string('btn_primary_text')->default('Janji Temu Online');
            $table->string('btn_primary_link')->default('#janji-temu');
            $table->string('btn_secondary_text')->default('Layanan Kami');
            $table->string('btn_secondary_link')->default('#layanan');
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->timestamps();
        });

        Schema::create('info_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(1);
            $table->string('icon')->default('doctor'); // doctor, emergency, clock, hospital, etc.
            $table->string('title');
            $table->string('description');
            $table->boolean('is_featured')->default(false); // Card ke-2 featured hijau gelap
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_cards');
        Schema::dropIfExists('hero_sections');
    }
};
