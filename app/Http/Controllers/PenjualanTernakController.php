<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanTernak;
use App\Models\Ternak;
use App\Models\Pelanggan;

class PenjualanTernakController extends Controller
{
    public function index()
    {
        $penjualan = PenjualanTernak::with(['ternak', 'pelanggan'])->orderBy('created_at', 'asc')->get();
        return view('penjualan_ternak.index', compact('penjualan'));
    }

    public function create()
    {
        $ternakList = Ternak::all()->mapWithKeys(fn($t) => [$t->id_ternak => $t->id_ternak . ' - ' . $t->jenis]);
        $pelangganList = Pelanggan::pluck('nama', 'id');
        return view('penjualan_ternak.create', compact('ternakList', 'pelangganList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'id_ternak' => 'required|exists:ternak,id_ternak',
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'harga_jual' => 'required|integer|min:0',
        ]);

        PenjualanTernak::create($request->all());
        return redirect()->route('penjualan_ternak.index')->with('success', 'Data penjualan berhasil disimpan.');
    }

    public function edit($id)
    {
        $penjualan = PenjualanTernak::findOrFail($id);
        $ternakList = Ternak::all()->mapWithKeys(fn($t) => [$t->id_ternak => $t->id_ternak . '-' . $t->jenis]);
        $pelangganList = Pelanggan::pluck('nama', 'id');
        return view('penjualan_ternak.edit', compact('penjualan', 'ternakList', 'pelangganList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
    'tanggal' => 'required|date',
    'id_ternak' => 'required|exists:ternak,id_ternak',
    'id_pelanggan' => 'required|exists:pelanggan,id',
    'harga_jual' => 'required|integer|min:0',
]);


        $penjualan = PenjualanTernak::findOrFail($id);
        $penjualan->update($request->all());

        return redirect()->route('penjualan_ternak.index')->with('success', 'Data penjualan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penjualan = PenjualanTernak::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan_ternak.index')->with('success', 'Data penjualan berhasil dihapus.');
    }
}
