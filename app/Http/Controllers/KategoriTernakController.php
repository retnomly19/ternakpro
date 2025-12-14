<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriTernak;

class KategoriTernakController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $kategori = KategoriTernak::orderBy('nama', 'asc')->paginate(10);
        return view('kategori_ternak.index', compact('kategori'));
    }

    // Form tambah kategori
    public function create()
    {
        return view('kategori_ternak.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategori_ternak,nama'
        ]);

        KategoriTernak::create($validated);

        return redirect()->route('kategori_ternak.index')
                         ->with('success', 'Kategori ternak berhasil ditambahkan.');
    }

    // Form edit kategori
    public function edit($id)
    {
        $kategori = KategoriTernak::findOrFail($id);
        return view('kategori_ternak.edit', compact('kategori'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $kategori = KategoriTernak::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategori_ternak,nama,' . $kategori->id
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori_ternak.index')
                         ->with('success', 'Kategori ternak berhasil diperbarui.');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $kategori = KategoriTernak::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori_ternak.index')
                         ->with('success', 'Kategori ternak berhasil dihapus.');
    }
}
