<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisAktivitas extends Model
{
    protected $table = 'jenis_aktivitas';
    protected $fillable = ['nama', 'keterangan'];
}