<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas;
use App\Models\JenisAktivitas;
use App\Models\Ternak;
use App\Models\PenjualanTernak;
use App\Models\Kandang;


class LaporanController extends Controller
{
     public function index()
    {
        return view('laporan.index');
    }

    public function aktivitas(Request $request)
{
    $query = Aktivitas::with(['jenisAktivitas', 'ternakList']);

    // Filter bulan
    if ($request->filled('bulan')) {
        $query->whereMonth('tanggal', $request->bulan);
    }

    // Filter tahun
    if ($request->filled('tahun')) {
        $query->whereYear('tanggal', $request->tahun);
    }

    // Filter kandang berdasarkan nama (lokasi)
    if ($request->filled('kandang')) {
        $query->whereHas('ternakList', function ($q) use ($request) {
            $q->where('lokasi', $request->kandang);
        });
    }

    $data = $query->get();

    // Ambil daftar nama kandang unik dari ternak
    $kandangList = Ternak::select('lokasi')->distinct()->pluck('lokasi');

    return view('laporan.aktivitas', compact('data', 'kandangList'));
}



public function persediaan(Request $request)
{
    $excludedTernakIds = Aktivitas::with('ternakList')
        ->get()
        ->flatMap(function ($aktivitas) {
            return $aktivitas->ternakList
                ->filter(fn($pivot) => in_array($pivot->pivot->kondisi, ['mati', 'dijual']))
                ->pluck('id_ternak');
        })
        ->unique()
        ->values();

    $query = Ternak::with('pemasok')
        ->whereNotIn('id_ternak', $excludedTernakIds);

    if ($request->filled('bulan')) {
        $query->whereMonth('tanggal_masuk', $request->bulan);
    }

    if ($request->filled('tahun')) {
        $query->whereYear('tanggal_masuk', $request->tahun);
    }

    if ($request->filled('kandang')) {
        $query->where('lokasi', $request->kandang);
    }

    $data = $query->get();
    $kandangList = Ternak::select('lokasi')->distinct()->pluck('lokasi');

    return view('laporan.persediaan', compact('data', 'kandangList'));
}

public function penjualan(Request $request)
{
    $query = PenjualanTernak::with('ternak', 'pelanggan');

    if ($request->filled('bulan')) {
        $query->whereMonth('tanggal', $request->bulan);
    }

    if ($request->filled('tahun')) {
        $query->whereYear('tanggal', $request->tahun);
    }

    if ($request->filled('kandang')) {
    $query->whereHas('ternak', function ($q) use ($request) {
        $q->where('lokasi', $request->kandang); // ✅ cocokkan ke nama kandang
    });
}

    

    $data = $query->get();
$kandangList = Ternak::select('lokasi')->distinct()->pluck('lokasi');

    return view('laporan.penjualan', compact('data', 'kandangList'));
}


public function kematian(Request $request)
{
    $query = Aktivitas::query();

    // Filter tanggal
    if ($request->filled('bulan')) {
        $query->whereMonth('tanggal', $request->bulan);
    }

    if ($request->filled('tahun')) {
        $query->whereYear('tanggal', $request->tahun);
    }

    if ($request->filled('kandang')) {
        $query->where('id_kandang', $request->kandang);
    }

    $aktivitasList = $query->with('ternakList')->get();

    // Ambil hanya ternak yang kondisi = 'mati'
    $data = [];
    foreach ($aktivitasList as $aktivitas) {
        foreach ($aktivitas->ternakList as $ternak) {
            if ($ternak->pivot->kondisi === 'mati') {
                $data[] = [
                    'tanggal' => $aktivitas->tanggal,
                    'id_ternak' => $ternak->id_ternak,
                    'jenis' => $ternak->jenis,
                    'kandang' => $ternak->lokasi ?? '-',
                    'penanggung_jawab' => $ternak->penanggung_jawab,
                    'keterangan' => $ternak->pivot->keterangan,
                ];
            }
        }
    }

    $kandangList = Kandang::pluck('nama', 'id_kandang');
return view('laporan.kematian', compact('data', 'kandangList'));
}

}
