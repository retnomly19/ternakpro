<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('penjualan_ternak', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->string('id_ternak');        
        $table->unsignedBigInteger('id_pelanggan');
        $table->integer('harga_jual');
        $table->timestamps();

        // Relasi ke tabel ternak
        $table->foreign('id_ternak')->references('id_ternak')->on('ternak')->onDelete('cascade');

        // Relasi ke tabel pelanggan
        $table->foreign('id_pelanggan')->references('id')->on('pelanggan')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_ternak');
    }
};
