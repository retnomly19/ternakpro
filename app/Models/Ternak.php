<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pemasok;
use App\Models\AktivitasTernak;
use App\Models\Kandang;


class Ternak extends Model
{
    use HasFactory;

    protected $table = 'ternak';

    // Primary key menggunakan string (bukan auto increment)
    protected $primaryKey = 'id_ternak';
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'id_ternak',
        'foto',
        'kategori',
        'jenis',
        'lokasi',
        'umur',
        'jenis_kelamin',
        'harga_beli',
        'kondisi',
        'tanggal_masuk',
        'vaksinasi',
        'penanggung_jawab',
        'pemasok_id',
        'cek_medis_terakhir',
          
    ];

    // Casting kolom tanggal ke Carbon instance
    protected $casts = [
        'tanggal_masuk' => 'date',
        'cek_medis_terakhir' => 'date',
    ];

    // Relasi ke Pemasok (1 Ternak dimiliki oleh 1 Pemasok)
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'pemasok_id');
    }

    public function aktivitasDetail()
{
    return $this->hasMany(AktivitasTernak::class, 'id_ternak', 'id_ternak');
}

public function kandang()
{
    return $this->belongsTo(Kandang::class, 'id_kandang', 'id_kandang');
}


}
