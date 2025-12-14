<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aktivitas_ternak', function (Blueprint $table) {
            $table->id();

            // Relasi ke aktivitas (id bigint)
            $table->unsignedBigInteger('aktivitas_id');
            $table->foreign('aktivitas_id')
                  ->references('id')
                  ->on('aktivitas')
                  ->onDelete('cascade');

            // Relasi ke ternak (id varchar)
            $table->string('id_ternak');
            $table->foreign('id_ternak')
                  ->references('id_ternak')
                  ->on('ternak')
                  ->onDelete('cascade');

            // Kolom status ternak
            $table->enum('ada', ['ada', 'tidak'])->default('ada');
            $table->enum('kondisi', ['sehat', 'sakit', 'lainnya'])->default('sehat');
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aktivitas_ternak');
    }
};
