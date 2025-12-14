@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-3 max-w-4xl">
    <div class="text-center mb-3">
        <h1 class="text-2xl font-semibold">✎Edit Data Ternak</h1>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 p-2 rounded mb-3">
            <ul class="text-sm text-red-700 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg">
        <form action="{{ route('ternak.update', $ternak->id_ternak) }}" method="POST" enctype="multipart/form-data" id="ternakEditForm">
            @csrf
            @method('PUT')

            {{-- Tab buttons --}}
            <div class="flex justify-center mb-3 pt-3">
                <button type="button" id="tabInformasiBtn" class="tab-btn px-4 py-1 text-sm font-medium bg-blue-600 text-white rounded-t">Informasi Umum</button>
                <button type="button" id="tabPemasokBtn" class="tab-btn px-4 py-1 text-sm font-medium ml-2 bg-gray-100 text-gray-700 rounded-t">Kontak Pemasok</button>
            </div>

            {{-- Informasi Umum --}}
            <div id="tabInformasi" class="tab-pane px-4 py-4">
            <div class="grid grid-cols-1 md:grid-cols-10 gap-2">
    {{-- ID Ternak --}}
    <div class="md:col-span-5">
        <label class="block text-sm font-medium mb-1">ID Ternak</label>
        <input type="text" name="id_ternak" value="{{ $ternak->id_ternak }}" readonly
               class="w-full border rounded px-3 py-2 text-sm bg-gray-100 cursor-not-allowed">
    </div>

    {{-- Harga Beli --}}
    <div class="md:col-span-5">
        <label class="block text-sm font-medium mb-1">Harga Beli <span class="text-red-600">*</span></label>
        <input type="number" name="harga_beli" value="{{ old('harga_beli', $ternak->harga_beli) }}" step="0.01" min="0" required
               class="w-full border rounded px-3 py-2 text-sm">
    </div>

    {{-- Kategori --}}
    <div class="md:col-span-5">
        <label class="block text-sm font-medium mb-1">Kategori <span class="text-red-600">*</span></label>
        <select name="kategori" id="kategoriSelectEdit" class="w-full border rounded px-3 py-2 text-sm">
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoriList ?? \App\Models\KategoriTernak::all() as $cat)
                <option value="{{ $cat->nama }}" @selected(old('kategori', $ternak->kategori) == $cat->nama)>{{ $cat->nama }}</option>
            @endforeach
            <option value="__new">✚ Tambah Kategori Baru</option>
        </select>
        <input type="text" name="kategori_baru" id="kategoriBaruInputEdit" value="{{ old('kategori_baru') }}"
               placeholder="Kategori baru..." class="w-full border rounded px-3 py-2 text-sm mt-1 hidden">
    </div>

    {{-- Kondisi --}}
    <div class="md:col-span-5">
        <label class="block text-sm font-medium mb-1">Kondisi <span class="text-red-600">*</span></label>
        <select name="kondisi" required class="w-full border rounded px-3 py-2 text-sm">
            <option value="">-- Pilih --</option>
            <option value="Sehat" @selected(old('kondisi', $ternak->kondisi)=='Sehat')>Sehat</option>
            <option value="Sakit" @selected(old('kondisi', $ternak->kondisi)=='Sakit')>Sakit</option>
        </select>
    </div>

    {{-- Jenis Ternak --}}
    <div class="md:col-span-5">
        <label class="block text-sm font-medium mb-1">Jenis Ternak <span class="text-red-600">*</span></label>
        <input type="text" name="jenis" value="{{ old('jenis', $ternak->jenis) }}" required
               class="w-full border rounded px-3 py-2 text-sm">
    </div>

    {{-- Lokasi --}}
    <div class="md:col-span-5">
        <label class="block text-sm font-medium mb-1">Lokasi <span class="text-red-600">*</span></label>
        <select name="lokasi" required class="w-full border rounded px-3 py-2 text-sm">
            <option value="">-- Pilih Lokasi --</option>
            @foreach(['Kandang A','Kandang B','Kandang C','Kandang D'] as $loc)
                <option value="{{ $loc }}" @selected(old('lokasi', $ternak->lokasi) == $loc)>{{ $loc }}</option>
            @endforeach
        </select>
    </div>

    {{-- Umur --}}
    <div class="md:col-span-5">
        <label class="block text-sm font-medium mb-1">Umur (bulan) <span class="text-red-600">*</span></label>
        <input type="number" name="umur" min="0" value="{{ old('umur', $ternak->umur) }}" required
               class="w-full border rounded px-3 py-2 text-sm">
    </div>

    {{-- Tanggal Masuk --}}
    <div class="md:col-span-5">
        <label class="block text-sm font-medium mb-1">Tanggal Masuk <span class="text-red-600">*</span></label>
        <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $ternak->tanggal_masuk->format('Y-m-d')) }}" required
               class="w-full border rounded px-3 py-2 text-sm">
    </div>

    {{-- Jenis Kelamin --}}
    <div class="md:col-span-5">
        <label class="block text-sm font-medium mb-1">Jenis Kelamin <span class="text-red-600">*</span></label>
        <select name="jenis_kelamin" required class="w-full border rounded px-3 py-2 text-sm">
            <option value="">-- Pilih --</option>
            <option value="Jantan" @selected(old('jenis_kelamin', $ternak->jenis_kelamin)=='Jantan')>Jantan</option>
            <option value="Betina" @selected(old('jenis_kelamin', $ternak->jenis_kelamin)=='Betina')>Betina</option>
        </select>
    </div>

    {{-- Daftar Vaksinasi --}}
    <div class="md:col-span-5">
        <label class="block text-sm font-medium mb-1">Daftar Vaksinasi</label>
        <input type="text" name="vaksinasi" value="{{ old('vaksinasi', $ternak->vaksinasi) }}"
               class="w-full border rounded px-3 py-2 text-sm">
    </div>

    {{-- Penanggung Jawab Perawatan --}}
    <div class="md:col-span-5">
        <label for="penanggung_jawab" class="block text-sm font-medium mb-1">Penanggung Jawab Perawatan</label>
        <select name="penanggung_jawab" id="penanggung_jawab" required
                class="w-full border rounded px-3 py-2 text-sm">
            <option value="" disabled>-- Pilih Penanggung Jawab --</option>
            <option value="PT" {{ old('penanggung_jawab', $ternak->penanggung_jawab) == 'PT' ? 'selected' : '' }}>PT</option>
            @foreach($mitraList as $id => $nama)
                @php
                    $value = 'mitra-' . $id;
                    $label = $value . '-' . $nama;
                @endphp
                <option value="{{ $value }}" {{ old('penanggung_jawab', $ternak->penanggung_jawab) == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Tanggal Cek Medis Terakhir --}}
    <div class="md:col-span-5">
        <label class="block text-sm font-medium mb-1">Tanggal Cek Medis Terakhir</label>
        <input type="date" name="cek_medis_terakhir"
               value="{{ old('cek_medis_terakhir', $ternak->cek_medis_terakhir ? $ternak->cek_medis_terakhir->format('Y-m-d') : '') }}"
               class="w-full border rounded px-3 py-2 text-sm">
    </div>

    {{-- Foto --}}
    <div class="md:col-span-10 mt-1">
        <label class="block text-sm font-medium mb-1">Foto</label>
        @if($ternak->foto)
            <img src="{{ asset('storage/'.$ternak->foto) }}" alt="Foto"
                 class="w-full max-w-xs h-auto object-cover mb-2 rounded shadow">
        @endif
        <input type="file" name="foto" accept="image/*"
               class="w-full border rounded px-3 py-2 text-sm">
    </div>
</div>
                {{-- Tombol Selanjutnya --}}
                <div class="md:col-span-10 mt-2 flex justify-end gap-2">
                    <button type="button" id="toPemasok" class="bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm">Selanjutnya</button>
                </div>
            </div>
            

            {{-- Kontak Pemasok --}}
            <div id="tabPemasok" class="tab-pane hidden px-4 py-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Nama Pemasok --}}
        <div>
            <label class="block text-sm font-medium mb-1">Nama Pemasok</label>
            <input type="text" name="nama_pemasok" value="{{ old('nama_pemasok', $ternak->pemasok->nama ?? '') }}"
                   class="w-full border rounded px-3 py-2 text-sm">
        </div>

        {{-- Telepon Pemasok --}}
        <div>
            <label class="block text-sm font-medium mb-1">Telepon Pemasok</label>
            <input type="text" name="telepon_pemasok" value="{{ old('telepon_pemasok', $ternak->pemasok->telepon ?? '') }}"
                   class="w-full border rounded px-3 py-2 text-sm">
        </div>

        {{-- Email Pemasok --}}
        <div>
            <label class="block text-sm font-medium mb-1">Email Pemasok</label>
            <input type="email" name="email_pemasok" value="{{ old('email_pemasok', $ternak->pemasok->email ?? '') }}"
                   class="w-full border rounded px-3 py-2 text-sm">
        </div>

        {{-- Alamat Pemasok --}}
        <div>
            <label class="block text-sm font-medium mb-1">Alamat Pemasok</label>
            <input type="text" name="alamat_pemasok" value="{{ old('alamat_pemasok', $ternak->pemasok->alamat ?? '') }}"
                   class="w-full border rounded px-3 py-2 text-sm">
        </div>

        {{-- Hubungan --}}
<div class="md:col-span-2">
    <label class="block text-sm font-medium mb-1">Hubungan</label>
    <input type="text" name="hubungan_pemasok" value="{{ old('hubungan_pemasok', $ternak->pemasok->hubungan ?? '') }}"
           class="w-full border rounded px-3 py-2 text-sm">
</div>


    </div>

    {{-- Tombol Sebelumnya + Simpan --}}
    <div class="mt-4 flex justify-between gap-2">
        <button type="button" id="toInformasi" class="bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm">Sebelumnya</button>
        <div class="flex items-center gap-2">
            <button type="reset" class="bg-gray-100 text-gray-700 px-3 py-1 rounded text-sm">Reset</button>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Simpan Perubahan</button>
        </div>
    </div>
</div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabInformasiBtn = document.getElementById('tabInformasiBtn');
    const tabPemasokBtn = document.getElementById('tabPemasokBtn');
    const tabInformasi = document.getElementById('tabInformasi');
    const tabPemasok = document.getElementById('tabPemasok');

    const toPemasok = document.getElementById('toPemasok');
    const toInformasi = document.getElementById('toInformasi');

    function showInformasi() {
        tabInformasi.classList.remove('hidden');
        tabPemasok.classList.add('hidden');
        tabInformasiBtn.classList.add('bg-blue-600','text-white');
        tabInformasiBtn.classList.remove('bg-gray-100','text-gray-700');
        tabPemasokBtn.classList.remove('bg-blue-600','text-white');
        tabPemasokBtn.classList.add('bg-gray-100','text-gray-700');
    }

    function showPemasok() {
        tabPemasok.classList.remove('hidden');
        tabInformasi.classList.add('hidden');
        tabPemasokBtn.classList.add('bg-blue-600','text-white');
        tabPemasokBtn.classList.remove('bg-gray-100','text-gray-700');
        tabInformasiBtn.classList.remove('bg-blue-600','text-white');
        tabInformasiBtn.classList.add('bg-gray-100','text-gray-700');
    }

    tabInformasiBtn.addEventListener('click', showInformasi);
    tabPemasokBtn.addEventListener('click', showPemasok);

    toPemasok.addEventListener('click', function() {
        // minimal required check
        const required = ['jenis','kategori','umur','jenis_kelamin','harga_beli','kondisi','lokasi','tanggal_masuk'];
        let ok = true;
        for (let name of required) {
            const el = document.querySelector(`[name="${name}"]`);
            if (!el || !el.value) { ok = false; break; }
        }
        if (!ok) { alert('Lengkapi semua field wajib di Informasi Umum.'); showInformasi(); return; }
        showPemasok();
    });

    toInformasi.addEventListener('click', showInformasi);

    // kategori baru toggle edit
    const kategoriSelectEdit = document.getElementById('kategoriSelectEdit') || document.getElementById('kategoriSelect');
    const kategoriBaruInputEdit = document.getElementById('kategoriBaruInputEdit') || document.getElementById('kategoriBaruInput');
    if (kategoriSelectEdit) {
        kategoriSelectEdit.addEventListener('change', function() {
            if (this.value === '__new') { kategoriBaruInputEdit.classList.remove('hidden'); kategoriBaruInputEdit.required = true; }
            else { kategoriBaruInputEdit.classList.add('hidden'); kategoriBaruInputEdit.required = false; kategoriBaruInputEdit.value = ''; }
        });
    }

    // start on informasi tab
    showInformasi();
});
</script>
@endsection
