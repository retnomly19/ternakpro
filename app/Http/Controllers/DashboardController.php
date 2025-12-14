<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ternak;
use App\Models\Kandang;
use App\Models\Aktivitas;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil hanya kategori Kambing & Domba
        $kategoriLabels = ['Kambing', 'Domba'];
        $kategoriCounts = [];

        foreach ($kategoriLabels as $kategori) {
            $kategoriCounts[] = Ternak::where('kategori', $kategori)->count();
        }

        $jumlahTernak = Ternak::count();
        $jumlahKandang = Kandang::count();
        $jumlahAktivitas = Aktivitas::count();

        return view('dashboard', compact(
            'kategoriLabels',
            'kategoriCounts',
            'jumlahTernak',
            'jumlahKandang',
            'jumlahAktivitas'
        ));
    }

    public function filterKategori(Request $request)
    {
        $kategori = $request->kategori;

        if ($kategori == 'all') {
            $labels = ['Kambing', 'Domba'];
        } else {
            $labels = [$kategori];
        }

        $data = [];
        foreach ($labels as $label) {
            $data[] = Ternak::where('kategori', $label)->count();
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
