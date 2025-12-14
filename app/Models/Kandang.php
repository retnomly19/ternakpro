<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandang extends Model
{
    use HasFactory;

    protected $table = 'kandang';
    protected $primaryKey = 'id_kandang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kandang',
        'nama',
        'lokasi',
        'penanggung_jawab',
        'jenis_ternak'
    ];


    // Jika pakai timestamps
    public $timestamps = true;

    // Tambahan: accessor atau mutator bisa ditambahkan di sini jika dibutuhkan
}
