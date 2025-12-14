<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasok;
use App\Models\Mitra;
use App\Models\Pelanggan;

class SettingController extends Controller
{
    // ===================== PEMASOK =====================
    public function pemasok()
    {
        $pemasok = Pemasok::all();
        return view('setting.pemasok.index', compact('pemasok'));
    }

    public function createPemasok()
    {
        return view('setting.pemasok.create');
    }

    public function storePemasok(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'nullable|email',
        ]);

        Pemasok::create($request->all());
        return redirect()->route('pemasok.index')->with('success', 'Data pemasok berhasil ditambahkan');
    }

    public function editPemasok($id)
    {
        $pemasok = Pemasok::findOrFail($id);
        return view('setting.pemasok.edit', compact('pemasok'));
    }
    public function updatePemasok(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'nullable|string',
        'telepon' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'hubungan' => 'nullable|string|max:50',
    ]);

    $pemasok = \App\Models\Pemasok::findOrFail($id);
    $pemasok->update($request->only(['nama', 'alamat', 'telepon', 'email', 'hubungan']));

    return redirect()->route('pemasok.index')->with('success', 'Data pemasok berhasil diperbarui.');
}

public function destroyPemasok($id)
{
    $pemasok = \App\Models\Pemasok::findOrFail($id);
    $pemasok->delete();

    return redirect()->route('pemasok.index')->with('success', 'Data pemasok berhasil dihapus.');
}


    // ===================== MITRA =====================
    public function mitra()
    {
        $mitra = Mitra::all();
        return view('setting.mitra.index', compact('mitra'));
    }

    public function createMitra()
    {
        return view('setting.mitra.create');
    }

    public function storeMitra(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'nullable|email',
        ]);

        Mitra::create($request->all());
        return redirect()->route('mitra.index')->with('success', 'Data mitra berhasil ditambahkan');
    }

    public function editMitra($id)
    {
        $mitra = Mitra::findOrFail($id);
        return view('setting.mitra.edit', compact('mitra'));
    }
public function updateMitra(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'nullable|string',
        'telepon' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
    ]);

    $mitra = \App\Models\Mitra::findOrFail($id);
    $mitra->update($request->only(['nama', 'alamat', 'telepon', 'email']));

    return redirect()->route('mitra.index')->with('success', 'Data mitra berhasil diperbarui.');
}

public function destroyMitra($id)
{
    $mitra = \App\Models\Mitra::findOrFail($id);
    $mitra->delete();

    return redirect()->route('mitra.index')->with('success', 'Data mitra berhasil dihapus.');
}

    // ===================== PELANGGAN =====================
    public function pelanggan()
    {
        $pelanggan = Pelanggan::all();
        return view('setting.pelanggan.index', compact('pelanggan'));
    }

    public function createPelanggan()
    {
        return view('setting.pelanggan.create');
    }

    public function storePelanggan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'nullable|email',
        ]);

        Pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    public function editPelanggan($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('setting.pelanggan.edit', compact('pelanggan'));
    }
    public function updatePelanggan(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'nullable|string',
        'telepon' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
    ]);

    $pelanggan = \App\Models\Pelanggan::findOrFail($id);
    $pelanggan->update($request->only(['nama', 'alamat', 'telepon', 'email']));

    return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
}

public function destroyPelanggan($id)
{
    $pelanggan = \App\Models\Pelanggan::findOrFail($id);
    $pelanggan->delete();

    return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
}

}
