<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanTernak extends Model
{
    protected $table = 'penjualan_ternak';

    protected $fillable = [
        'tanggal',
        'id_ternak',
        'id_pelanggan',
        'harga_jual',
    ];

    public function ternak()
    {
        return $this->belongsTo(Ternak::class, 'id_ternak','id_ternak');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}

