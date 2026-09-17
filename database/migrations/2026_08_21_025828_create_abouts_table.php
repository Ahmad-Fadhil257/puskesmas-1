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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('badge_label')->default('Tentang Kami');
            $table->text('title');
            $table->text('description');
            $table->string('image_main')->nullable();
            $table->string('image_accent')->nullable();
            $table->string('visi_title')->default('Visi Kami');
            $table->text('visi_text');
            $table->string('misi_title')->default('Misi Kami');
            $table->text('misi_text');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
