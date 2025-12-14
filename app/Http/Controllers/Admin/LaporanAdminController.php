<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aktivitas;
use App\Models\Ternak;

class LaporanAdminController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function aktivitas(Request $request)
    {
        $query = Aktivitas::with(['jenisAktivitas', 'ternakList']);

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->filled('kandang')) {
            $query->whereHas('ternakList', function ($q) use ($request) {
                $q->where('lokasi', $request->kandang);
            });
        }

        $data = $query->get();
        $kandangList = Ternak::select('lokasi')->distinct()->pluck('lokasi');

        return view('admin.laporan.aktivitas', compact('data', 'kandangList'));
    }
}
