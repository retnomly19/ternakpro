<?php

// database/migrations/xxxx_xx_xx_create_pemasok_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasokTable extends Migration
{
    public function up()
    {
        Schema::create('pemasok', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->enum('hubungan', ['Pihak Ketiga', 'Pihak Berelasi'])->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemasok');
    }
}
