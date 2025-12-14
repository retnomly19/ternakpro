<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKategoriLokasiToTernakTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('ternak', function (Blueprint $table) {
        $table->string('kategori', 100)->after('id_ternak');
        $table->string('lokasi', 100)->after('jenis_kelamin');
        $table->string('vaksinasi')->nullable()->after('kondisi');
        $table->date('cek_medis_terakhir')->nullable()->after('vaksinasi');
    });
}

public function down(): void
{
    Schema::table('ternak', function (Blueprint $table) {
        $table->dropColumn(['kategori', 'lokasi', 'vaksinasi', 'cek_medis_terakhir']);
    });
}
}
