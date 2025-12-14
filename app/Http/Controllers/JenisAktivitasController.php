<?php

namespace App\Http\Controllers;

use App\Models\JenisAktivitas;
use Illuminate\Http\Request;

class JenisAktivitasController extends Controller
{
    public function index()
    {
        $jenisAktivitas = JenisAktivitas::orderBy('nama')->get();
        return view('jenis_aktivitas.index', compact('jenisAktivitas'));
    }

    public function create()
    {
        return view('jenis_aktivitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string'
        ]);

        JenisAktivitas::create([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('jenis_aktivitas.index')->with('success', 'Jenis aktivitas berhasil ditambahkan');
    }

    public function edit(JenisAktivitas $jenisAktivitas)
    {
        return view('jenis_aktivitas.edit', compact('jenisAktivitas'));
    }

    public function update(Request $request, JenisAktivitas $jenisAktivitas)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string'
        ]);

        $jenisAktivitas->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('jenis_aktivitas.index')->with('success', 'Jenis aktivitas berhasil diperbarui');
    }

    public function destroy(JenisAktivitas $jenisAktivitas)
    {
        $jenisAktivitas->delete();
        return redirect()->route('jenis_aktivitas.index')->with('success', 'Jenis aktivitas berhasil dihapus');
    }
}
