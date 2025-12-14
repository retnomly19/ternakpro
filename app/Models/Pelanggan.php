<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ternak;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
        'email',
        'hubungan',
    ];

    public function ternak()
    {
        return $this->hasMany(Ternak::class, 'pelanggan_id');
    }
}
