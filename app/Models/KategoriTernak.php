<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriTernak extends Model
{
    use HasFactory;

    protected $table = 'kategori_ternak'; // nama tabel sesuai migration
    protected $fillable = ['nama'];
}
