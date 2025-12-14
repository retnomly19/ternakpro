<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas;
use App\Models\Kandang;
use App\Models\JenisAktivitas;
use App\Models\Ternak;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Mitra;

class AktivitasController extends Controller
{
    // Tampilkan halaman dashboard aktivitas
    public function index()
    {
        $aktivitas = Aktivitas::with(['kandang', 'jenisAktivitas'])->orderBy('tanggal','desc')->get();
        $kandang = Kandang::all();
        $jenisAktivitas = JenisAktivitas::all();

        return view('aktivitas.index', compact('aktivitas', 'kandang', 'jenisAktivitas'));
    }

    public function create()
{
    $kandang = Kandang::all();
    $jenisAktivitas = JenisAktivitas::all();

    return view('aktivitas.create', compact('kandang', 'jenisAktivitas'));
}

    // Simpan aktivitas baru
    public function store(Request $request)
    {
        $tanggalInput = Carbon::parse($request->tanggal)->toDateString();
$today = now()->toDateString();

if ($tanggalInput === $today) {
    $status = 'on process';
} elseif ($tanggalInput > $today) {
    $status = 'on schedule';
} else {
    $status = 'completed'; // atau 'on process' kalau belum selesai
}

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'id_kandang' => 'required|exists:kandang,id_kandang',
            'jenis_aktivitas_id' => 'required|exists:jenis_aktivitas,id',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $validated['status'] = $status;

        $aktivitas = Aktivitas::create($validated);

        // Load relasi agar index bisa menampilkan nama
        $aktivitas->load(['kandang','jenisAktivitas']);

        return redirect()->route('aktivitas.index')->with('success', 'Aktivitas berhasil dibuat.');
    }    

    public function showDetail($id)
    {
        $aktivitas = Aktivitas::with(['kandang', 'jenisAktivitas'])->findOrFail($id);

        // Ambil ternak yang berada di kandang yang dipilih
        $ternakKandang = Ternak::where('lokasi', $aktivitas->kandang->nama)->get();
        $mitraList = Mitra::pluck('nama', 'id');
        return view('aktivitas.detail', compact('aktivitas', 'ternakKandang','mitraList'));
    }

    public function saveDetailTernak(Request $request, $id)
{
    $aktivitas = Aktivitas::findOrFail($id);

    foreach ($request->id_ternak as $index => $idTernak) {
    $aktivitas->ternakList()->syncWithoutDetaching([
        $idTernak => [
            'ada' => $request->ada[$index],
            'kondisi' => $request->kondisi[$index],
            'status_detail' => $request->status_detail[$index],
            'keterangan' => $request->keterangan[$index],
        ]
        ]);
    }

    $aktivitas->status = 'completed';
    $aktivitas->save();

    return redirect()->route('aktivitas.index')->with('success', 'Detail aktivitas berhasil disimpan.');
}


    public function print($id)
    {
        $aktivitas = Aktivitas::with(['kandang', 'jenisAktivitas', 'ternakList'])->findOrFail($id);

        return view('aktivitas.print', compact('aktivitas'));
    }
    public function edit($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        $kandang = Kandang::all();
        $jenisAktivitas = JenisAktivitas::all();

        return view('aktivitas.edit', compact('aktivitas', 'kandang', 'jenisAktivitas'));
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'tanggal' => 'required|date',
        'id_kandang' => 'required|exists:kandang,id_kandang',
        'jenis_aktivitas_id' => 'required|exists:jenis_aktivitas,id',
        'keterangan' => 'nullable|string',
    ]);

    $aktivitas = Aktivitas::findOrFail($id);
    $aktivitas->update([
        'tanggal' => $request->tanggal,
        'id_kandang' => $request->id_kandang,
        'jenis_aktivitas_id' => $request->jenis_aktivitas_id,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()->route('aktivitas.index')->with('success', 'Aktivitas berhasil diperbarui.');
}
    public function destroy($id)
{
    $aktivitas = Aktivitas::findOrFail($id);

    // Hapus relasi pivot dulu biar gak nyangkut
    $aktivitas->ternakList()->detach();

    // Hapus aktivitas
    $aktivitas->delete();

    return redirect()->route('aktivitas.index')->with('success', 'Aktivitas berhasil dihapus.');
}


}