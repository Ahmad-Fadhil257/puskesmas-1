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
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->nullable()->default('Puskesmas'); // Opsional / tidak wajib diisi
            $table->string('logo')->nullable(); // Uploaded logo filename
            $table->boolean('show_app_name')->default(true); // Toggle tampilkan nama teks
            $table->string('phone')->nullable()->default('(021) 555-0123');
            $table->string('email')->nullable()->default('info@puskesmas.go.id');
            $table->text('address')->nullable()->default('Jl. Kesehatan No. 123, Jakarta Selatan, 12345');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_settings');
    }
};
