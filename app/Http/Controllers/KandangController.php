<?php

namespace App\Http\Controllers;

use App\Models\Kandang;
use Illuminate\Http\Request;
use App\Models\KategoriTernak;

class KandangController extends Controller
{
    public function index()
    {
        $kandang = Kandang::all();
        return view('kandang.index', compact('kandang'));
    }

    public function create()
{
    $kategoriTernak = KategoriTernak::orderBy('nama','asc')->get(); // ambil kategori ternak
    return view('kandang.create', compact('kategoriTernak'));
}


    public function store(Request $request)
    {
        $request->validate([
            'id_kandang' => 'required|string|unique:kandang,id_kandang',
            'nama' => 'required|string',
            'lokasi' => 'required|string',
            'penanggung_jawab' => 'required|string',
            'jenis_ternak' => 'required|string',
        ]);

        Kandang::create($request->all());

        return redirect()->route('kandang.index')->with('success', 'Data kandang berhasil disimpan.');
    }

    public function edit($id)
{
    $kandang = Kandang::findOrFail($id);
    $kategoriTernak = KategoriTernak::orderBy('nama','asc')->get(); // ambil kategori ternak

    return view('kandang.edit', compact('kandang', 'kategoriTernak'));
}


    public function update(Request $request, $id_kandang)
    {
        $request->validate([
            'nama' => 'required|string',
            'lokasi' => 'required|string',
            'penanggung_jawab' => 'required|string',
            'jenis_ternak' => 'required|string',
        ]);

        $kandang = Kandang::findOrFail($id_kandang);
        $kandang->update($request->all());

        return redirect()->route('kandang.index')->with('success', 'Data kandang berhasil diperbarui.');
    }

    public function destroy($id_kandang)
    {
        $kandang = Kandang::findOrFail($id_kandang);
        $kandang->delete();

        return redirect()->route('kandang.index')->with('success', 'Data kandang berhasil dihapus.');
    }
}
