<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('jenis_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // nama jenis aktivitas
            $table->text('keterangan')->nullable(); // opsional
            $table->timestamps();
        });
    }

    /**
     * Reverse migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_aktivitas');
    }
};
