<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ternak;
use App\Models\Pemasok;
use App\Models\KategoriTernak;
use Illuminate\Support\Facades\Storage;

class TernakController extends Controller
{
    public function index(Request $request)
    {
        $query = Ternak::with('pemasok');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id_ternak', 'like', "%$search%")
                  ->orWhere('jenis', 'like', "%$search%")
                  ->orWhere('vaksinasi', 'like', "%$search%");
            });
        }

        if ($request->filled('filter_kategori')) {
            $query->where('kategori', $request->filter_kategori);
        }

        if ($request->filled('filter_umur')) {
            $range = $request->filter_umur;
            if ($range === '0-6') {
                $query->whereBetween('umur', [0, 6]);
            } elseif ($range === '7-12') {
                $query->whereBetween('umur', [7, 12]);
            } elseif ($range === '13-24') {
                $query->whereBetween('umur', [13, 24]);
            } elseif ($range === '25+') {
                $query->where('umur', '>=', 25);
            }
        }

        if ($request->filled('filter_jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->filter_jenis_kelamin);
        }

        if ($request->filled('filter_kondisi')) {
            $query->where('kondisi', $request->filter_kondisi);
        }

        if ($request->filled('filter_lokasi')) {
            $query->where('lokasi', $request->filter_lokasi);
        }

        $ternak = $query->orderBy('tanggal_masuk', 'desc')->paginate(10)->withQueryString();

        $kategoriList = KategoriTernak::all();

        return view('ternak.index', compact('ternak','kategoriList'));
    }

    public function create()
    {
        $kategoriList = KategoriTernak::all();
        $mitraList = \App\Models\Mitra::pluck('nama', 'id');
        $pemasokList = \App\Models\Pemasok::all();
        return view('ternak.create', compact('kategoriList','mitraList','pemasokList'));
        
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_ternak' => 'required|string|max:20|unique:ternak,id_ternak',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori' => 'nullable|string|max:50',
            'kategori_baru' => 'nullable|string|max:50',
            'jenis' => 'required|string|max:100',
            'lokasi' => 'required|string|max:50',
            'umur' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'harga_beli' => 'required|numeric|min:0',
            'kondisi' => 'required|string|max:50',
            'tanggal_masuk' => 'required|date',
            'vaksinasi' => 'nullable|string|max:255',
            'cek_medis_terakhir' => 'nullable|date',
            'penanggung_jawab' => 'nullable|string|max:100',            
// Pemasok
            'nama_pemasok' => 'required|string|max:255',
            'alamat_pemasok' => 'nullable|string|max:500',
            'telepon_pemasok' => 'nullable|string|max:20',
            'hubungan_pemasok' => 'nullable|string|max:100',

        ]);

        // Tentukan kategori
        $kategori = $validated['kategori'];
        if ($validated['kategori_baru']) {
            $kategoriBaru = KategoriTernak::firstOrCreate(['nama' => $validated['kategori_baru']]);
            $kategori = $kategoriBaru->nama;
        }

        // Simpan pemasok
        $pemasok = Pemasok::create([
            'nama' => $validated['nama_pemasok'],
            'alamat' => $validated['alamat_pemasok'] ?? null,
            'telepon' => $validated['telepon_pemasok'] ?? null,
            'hubungan' => $validated['hubungan_pemasok'] ?? null,
        ]);

        // Data ternak
        $ternakData = [
            'id_ternak' => $validated['id_ternak'],
            'kategori' => $kategori,
            'jenis' => $validated['jenis'],
            'lokasi' => $validated['lokasi'],
            'umur' => $validated['umur'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'harga_beli' => $validated['harga_beli'],
            'kondisi' => $validated['kondisi'],
            'tanggal_masuk' => $validated['tanggal_masuk'],
            'vaksinasi' => $validated['vaksinasi'] ?? null,
            'cek_medis_terakhir' => $validated['cek_medis_terakhir'] ?? null,
            'penanggung_jawab' => $validated['penanggung_jawab'] ?? null,

            'pemasok_id' => $pemasok->id,
        ];

        if ($request->hasFile('foto')) {
            $ternakData['foto'] = $request->file('foto')->store('foto_ternak', 'public');
        }

        Ternak::create($ternakData);

        return redirect()->route('ternak.index')->with('success', 'Data ternak dan pemasok berhasil ditambahkan.');
        
    }

    public function edit($id)
    {
        $ternak = Ternak::with('pemasok')->findOrFail($id);
        $kategoriList = KategoriTernak::all();
        $mitraList = \App\Models\Mitra::pluck('nama', 'id');
        return view('ternak.edit', compact('ternak','kategoriList','mitraList'));
    
    }

    public function update(Request $request, $id)
    {
        $ternak = Ternak::with('pemasok')->findOrFail($id);

        $validated = $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori' => 'nullable|string|max:50',
            'kategori_baru' => 'nullable|string|max:50',
            'jenis' => 'required|string|max:100',
            'lokasi' => 'required|string|max:50',
            'umur' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'harga_beli' => 'required|numeric|min:0',
            'kondisi' => 'required|string|max:50',
            'tanggal_masuk' => 'required|date',
            'vaksinasi' => 'nullable|string|max:255',
            'cek_medis_terakhir' => 'nullable|date',
            'nama_pemasok' => 'nullable|string|max:255',
            'alamat_pemasok' => 'nullable|string|max:500',
            'telepon_pemasok' => 'nullable|string|max:20',
            'hubungan_pemasok' => 'nullable|string|max:100',
            'penanggung_jawab' => 'nullable|string|max:100',

        ]);

        // Tentukan kategori
        $kategori = $validated['kategori'] ?? $ternak->kategori;
    if (!empty($validated['kategori_baru'])) {
        $kategoriBaru = KategoriTernak::firstOrCreate(['nama' => $validated['kategori_baru']]);
        $kategori = $kategoriBaru->nama;
    }
    $validated['kategori'] = $kategori;

        if ($request->hasFile('foto')) {
            if ($ternak->foto && Storage::disk('public')->exists($ternak->foto)) {
                Storage::disk('public')->delete($ternak->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto_ternak', 'public');
        }

        $ternak->update($validated);

        if ($ternak->pemasok) {
            $ternak->pemasok->update([
                'nama' => $validated['nama_pemasok'] ?? $ternak->pemasok->nama,
                'alamat' => $validated['alamat_pemasok'] ?? $ternak->pemasok->alamat,
                'telepon' => $validated['telepon_pemasok'] ?? $ternak->pemasok->telepon,
                'hubungan' => $validated['hubungan_pemasok'] ?? $ternak->pemasok->hubungan,
            ]);
        }

        return redirect()->route('ternak.index')->with('success', 'Data ternak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ternak = Ternak::findOrFail($id);

        if ($ternak->foto && Storage::disk('public')->exists($ternak->foto)) {
            Storage::disk('public')->delete($ternak->foto);
        }

        $ternak->delete();

        return redirect()->route('ternak.index')->with('success', 'Data ternak berhasil dihapus.');
    }

    public function destroyMultiple(Request $request)
    {
        $ids = $request->ids;

        if (!$ids || !is_array($ids)) {
            return redirect()->route('ternak.index')->with('error', 'Tidak ada data yang dipilih.');
        }

        foreach ($ids as $id) {
            $ternak = Ternak::find($id);
            if ($ternak) {
                if ($ternak->foto && Storage::disk('public')->exists($ternak->foto)) {
                    Storage::disk('public')->delete($ternak->foto);
                }
                $ternak->delete();
            }
        }

        return redirect()->route('ternak.index')->with('success', 'Data ternak berhasil dihapus.');
    }
}
