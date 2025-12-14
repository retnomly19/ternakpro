<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTernakTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ternak', function (Blueprint $table) {
            $table->string('id_ternak', 20)->primary();  // primary key
            $table->string('jenis', 100);
            $table->integer('umur')->default(0);
            $table->enum('jenis_kelamin', ['Jantan', 'Betina']);
            $table->decimal('harga_beli', 12, 2)->default(0);
            $table->string('kondisi', 100);
            $table->date('tanggal_masuk');
            $table->string('foto')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ternak');
    }
};