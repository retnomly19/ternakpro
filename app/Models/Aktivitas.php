<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisAktivitas;

class Aktivitas extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'id_kandang',
        'jenis_aktivitas_id',
        'tanggal',
        'keterangan',
        'status',
    ];

    // Otomatis load relasi saat query
    protected $with = ['kandang', 'jenisAktivitas', 'ternakList'];

    // Cast kolom tanggal
    protected $casts = [
        'tanggal' => 'date:Y-m-d',
    ];

    // Tambahkan accessor ke array/JSON
    protected $appends = ['status_text'];

    /**
     * Relasi ke Kandang
     */
    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'id_kandang','id_kandang');
    }

    /**
     * Relasi ke Jenis Aktivitas
     */
    public function jenisAktivitas()
    {
        return $this->belongsTo(JenisAktivitas::class, 'jenis_aktivitas_id', 'id');
    } 

    /**
     * Relasi many-to-many ke Ternak melalui pivot table aktivitas_ternak
     */
    public function ternakList()
    {
        return $this->belongsToMany(
            Ternak::class,          // Model Ternak
            'aktivitas_ternak',     // Nama tabel pivot
            'aktivitas_id',         // FK aktivitas di pivot
            'id_ternak'             // FK ternak di pivot
        )->withPivot('ada', 'kondisi', 'status_detail', 'keterangan')
         ->withTimestamps();
    }

    /**
     * Accessor untuk status readable
     */
    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'schedule' => 'On Schedule',
            'process'  => 'On Process',
            'completed'=> 'Completed',
            default    => ucfirst($this->status),
        };
    }
}
