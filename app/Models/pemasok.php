<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ternak;  // Import model Ternak supaya relasi dikenali

class Pemasok extends Model
{
    use HasFactory;

    protected $table = 'pemasok';

    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
        'email', 
        'hubungan',
    ];

    public function ternak()
    {
        return $this->hasMany(Ternak::class, 'pemasok_id');
    }
}
