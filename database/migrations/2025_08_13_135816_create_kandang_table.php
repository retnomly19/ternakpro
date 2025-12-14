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
        Schema::create('kandang', function (Blueprint $table) {
            $table->string('id_kandang')->primary(); // varchar primary key
            $table->string('nama');                  // nama kandang
            $table->string('lokasi');                // lokasi/desa
            $table->string('penanggung_jawab');      // penanggung jawab
            $table->string('jenis_ternak');          // jenis hewan ternak
            $table->timestamps();                     // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kandang');
    }
};
