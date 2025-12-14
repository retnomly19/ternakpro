@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Data Ternak</h1>
        <div class="flex items-center gap-2">
            <button id="openModal" 
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Data Ternak
            </button>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <div>
            <select id="kategoriDropdown" class="border rounded-md px-3 py-2">
                <option value="">Semua Kategori</option>
                <option value="Domba/Kambing">Domba/Kambing</option>
                <option value="Kerbau">Kerbau</option>
                <option value="Sapi">Sapi</option>
                <option value="Ayam">Ayam</option>
            </select>
        </div>
        <div class="relative w-full md:w-64">
            <input type="text" id="searchInput" placeholder="Cari..." 
                class="border rounded-md pl-10 pr-4 py-2 w-full">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </div>

    <!-- Tabel Data Ternak -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-center"><input type="checkbox" id="checkAll"></th>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Foto</th>
                    <th class="px-4 py-2">Kategori</th>
                    <th class="px-4 py-2">Jenis</th>
                    <th class="px-4 py-2">Umur (Bulan)</th>
                    <th class="px-4 py-2">JK</th>
                    <th class="px-4 py-2">Harga Beli</th>
                    <th class="px-4 py-2">Kondisi</th>
                    <th class="px-4 py-2">Lokasi</th>
                    <th class="px-4 py-2">Tanggal Masuk</th>
                    <th class="px-4 py-2">Last Update</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ternak as $item)
                    <tr>
                        <td class="px-4 py-2 text-center"><input type="checkbox" class="row-check"></td>
                        <td class="px-4 py-2">{{ $item->id_ternak }}</td>
                        <td class="px-4 py-2">
                            @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Ternak" 
                                class="rounded-md w-12 h-12 object-cover">
                            @else
                            <span class="text-gray-400 italic">Tidak ada foto</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $item->kategori }}</td>
                        <td class="px-4 py-2">{{ $item->jenis }}</td>
                        <td class="px-4 py-2">{{ $item->umur }}</td>
                        <td class="px-4 py-2">{{ $item->jenis_kelamin }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $item->kondisi }}</td>
                        <td class="px-4 py-2">{{ $item->lokasi }}</td>
                        <td class="px-4 py-2">{{ $item->tanggal_masuk->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">{{ $item->updated_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-2 text-center" colspan="12">Data ternak belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Data -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-start z-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-4xl p-6 min-h-[80vh] overflow-y-auto my-5 relative">
        <button id="closeModal" class="text-red-500 text-3xl absolute top-4 right-6 hover:text-red-700 transition">&times;</button>
        <h2 class="text-xl font-bold mb-4 text-center">Tambah Data Ternak</h2>

        <ul class="flex justify-center border-b mb-6" id="tabMenu">
            <li class="mx-3">
                <button class="tab-link text-blue-600 font-semibold border-b-2 border-blue-600 px-4 py-2" data-tab="informasiUmum" type="button">Informasi Umum</button>
            </li>
            <li class="mx-3">
                <button class="tab-link text-gray-600 font-semibold px-4 py-2" data-tab="kontakPemasok" type="button">Kontak Pemasok</button>
            </li>
        </ul>

        <form id="formTernak" action="{{ route('ternak.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="informasiUmum" class="tab-content grid grid-cols-1 md:grid-cols-2 gap-4 border-r pr-6">
                <div>
                    <label class="block font-semibold mb-1">ID Ternak</label>
                    <input type="text" name="id_ternak" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Jenis Ternak</label>
                    <input type="text" name="jenis" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Kategori</label>
                    <select name="kategori" class="w-full border rounded px-3 py-2" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Domba/Kambing">Domba/Kambing</option>
                        <option value="Kerbau">Kerbau</option>
                        <option value="Sapi">Sapi</option>
                        <option value="Ayam">Ayam</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Umur (Bulan)</label>
                    <input type="number" name="umur" min="0" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border rounded px-3 py-2" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Jantan">Jantan</option>
                        <option value="Betina">Betina</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Harga Beli</label>
                    <input type="number" name="harga_beli" min="0" step="0.01" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Kondisi</label>
                    <select name="kondisi" class="w-full border rounded px-3 py-2" required>
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="Sehat">Sehat</option>
                        <option value="Sakit">Sakit</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Lokasi</label>
                    <select name="lokasi" class="w-full border rounded px-3 py-2" required>
                        <option value="">-- Pilih Lokasi --</option>
                        <option value="Kandang A">Kandang A</option>
                        <option value="Kandang B">Kandang B</option>
                        <option value="Kandang C">Kandang C</option>
                        <option value="Kandang D">Kandang D</option>
                        <option value="Kandang E">Kandang E</option>
                        <option value="Kandang F">Kandang F</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Daftar Vaksinasi</label>
                    <input type="text" name="vaksinasi" class="w-full border rounded px-3 py-2" placeholder="Contoh: Rabies, Cacar">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Cek Medis Terakhir</label>
                    <input type="date" name="cek_medis_terakhir" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Foto Ternak</label>
                    <input type="file" name="foto" accept="image/*" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div id="kontakPemasok" class="tab-content hidden grid grid-cols-1 md:grid-cols-2 gap-4 px-6">
                <div>
                    <label class="block font-semibold mb-1">Nama Pemasok</label>
                    <input type="text" name="nama_pemasok" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Alamat</label>
                    <textarea name="alamat_pemasok" class="w-full border rounded px-3 py-2" rows="4"></textarea>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Telepon</label>
                    <input type="text" name="telepon_pemasok" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Hubungan</label>
                    <select name="hubungan_pemasok" class="w-full border rounded px-3 py-2">
                        <option value="">-- Pilih Hubungan --</option>
                        <option value="Pihak Ketiga">Pihak Ketiga</option>
                        <option value="Pihak Berelasi">Pihak Berelasi</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 border-t pt-3 sticky bottom-0 bg-white">
                <button type="button" id="prevButton" class="hidden bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400 transition">
                    Sebelumnya
                </button>
                <button type="button" id="nextButton" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Selanjutnya
                </button>
                <button type="submit" id="saveButton" class="hidden bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Tab control
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');
    const nextButton = document.getElementById('nextButton');
    const prevButton = document.getElementById('prevButton');
    const saveButton = document.getElementById('saveButton');

    function showTab(tabId) {
        tabContents.forEach(c => c.classList.add('hidden'));
        tabLinks.forEach(btn => {
            btn.classList.remove('text-blue-600', 'border-blue-600');
            btn.classList.add('text-gray-600');
        });
        document.getElementById(tabId).classList.remove('hidden');
        const activeBtn = Array.from(tabLinks).find(btn => btn.dataset.tab === tabId);
        if (activeBtn) {
            activeBtn.classList.add('text-blue-600', 'border-blue-600');
            activeBtn.classList.remove('text-gray-600');
        }

        if (tabId === 'kontakPemasok') {
            nextButton.classList.add('hidden');
            prevButton.classList.remove('hidden');
            saveButton.classList.remove('hidden');
        } else {
            nextButton.classList.remove('hidden');
            prevButton.classList.add('hidden');
            saveButton.classList.add('hidden');
        }
    }

    tabLinks.forEach(btn => {
        btn.addEventListener('click', () => {
            showTab(btn.dataset.tab);
        });
    });

    nextButton.addEventListener('click', () => {
        showTab('kontakPemasok');
    });

    prevButton.addEventListener('click', () => {
        showTab('informasiUmum');
    });

    // Modal open/close
    document.getElementById('openModal').addEventListener('click', () => {
        document.getElementById('modal').classList.remove('hidden');
        showTab('informasiUmum');
    });

    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('modal').classList.add('hidden');
    });

    // Select all checkbox logic
    const checkAll = document.getElementById('checkAll');
    const rowChecks = document.querySelectorAll('.row-check');

    checkAll.addEventListener('change', () => {
        rowChecks.forEach(chk => chk.checked = checkAll.checked);
    });
</script>
@endsection
