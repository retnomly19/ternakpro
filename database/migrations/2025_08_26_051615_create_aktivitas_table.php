<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id();

            // Relasi ke kandang (varchar)
            $table->string('id_kandang');
            $table->foreign('id_kandang')
                  ->references('id_kandang')
                  ->on('kandang')
                  ->onDelete('cascade');

            // Relasi ke jenis aktivitas (id auto increment)
            $table->unsignedBigInteger('jenis_aktivitas_id');
            $table->foreign('jenis_aktivitas_id')
                  ->references('id')
                  ->on('jenis_aktivitas')
                  ->onDelete('cascade');

            $table->date('tanggal');
            $table->text('keterangan')->nullable();

            $table->enum('status', ['on schedule','on process','completed'])->default('on schedule');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};
