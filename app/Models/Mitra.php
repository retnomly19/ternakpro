<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ternak;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'mitra';

    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
        'email',
        'hubungan',
    ];

    public function ternak()
    {
        return $this->hasMany(Ternak::class, 'mitra_id');
    }
}
