<!-- Modal Tambah Data Ternak -->
<div class="modal fade" id="modalTambahTernak" tabindex="-1" aria-labelledby="modalTambahTernakLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl mt-2"> <!-- mt-2 bikin modal lebih ke atas -->
    <div class="modal-content rounded-4">
      <div class="modal-header bg-primary text-white py-2"> <!-- py-2 biar header lebih rapat -->
        <h5 class="modal-title" id="modalTambahTernakLabel">Tambah Data Ternak</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('ternak.store') }}" method="POST" enctype="multipart/form-data" id="formTambahTernak">
        @csrf
        <div class="modal-body py-2"><!-- py-2 bikin body rapat -->
          
          <!-- Tabs -->
          <ul class="nav nav-tabs mb-2" id="ternakTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active py-1 px-3" id="umum-tab" data-bs-toggle="tab" data-bs-target="#umum" type="button" role="tab">Informasi Umum</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link py-1 px-3" id="pemasok-tab" data-bs-toggle="tab" data-bs-target="#pemasok" type="button" role="tab">Kontak Pemasok</button>
            </li>
          </ul>

          <!-- Isi Tab -->
          <div class="tab-content" id="ternakTabContent">
            
            <!-- Informasi Umum -->
            <div class="tab-pane fade show active" id="umum" role="tabpanel">
              <div class="row g-2"><!-- g-2 biar jarak antar input kecil -->
                
                <div class="col-md-6">
                  <label class="form-label">ID Ternak</label>
                  <input type="text" name="id_ternak" class="form-control form-control-sm" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Jenis Ternak</label>
                  <select name="jenis" class="form-select form-select-sm" required>
                    <option value="">Pilih</option>
                    <option value="Domba/Kambing">Domba/Kambing</option>
                    <option value="Kerbau">Kerbau</option>
                    <option value="Sapi">Sapi</option>
                    <option value="Ayam">Ayam</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Kategori</label>
                  <select name="kategori" class="form-select form-select-sm" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoriList as $kategori)
                      <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Lokasi</label>
                  <select name="lokasi" class="form-select form-select-sm" required>
                    <option value="">Pilih Lokasi</option>
                    @foreach($lokasiList as $lokasi)
                      <option value="{{ $lokasi->nama_lokasi }}">{{ $lokasi->nama_lokasi }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-select form-select-sm" required>
                    <option value="">Pilih</option>
                    <option value="Jantan">Jantan</option>
                    <option value="Betina">Betina</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Umur (bulan)</label>
                  <input type="number" name="umur" class="form-control form-control-sm" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Harga Beli</label>
                  <input type="number" name="harga_beli" class="form-control form-control-sm" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Kondisi</label>
                  <select name="kondisi" class="form-select form-select-sm" required>
                    <option value="">Pilih</option>
                    <option value="Sehat">Sehat</option>
                    <option value="Sakit">Sakit</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Tanggal Masuk</label>
                  <input type="date" name="tanggal_masuk" class="form-control form-control-sm" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Daftar Vaksinasi</label>
                  <input type="text" name="vaksinasi" class="form-control form-control-sm">
                </div>

                <div class="col-md-6">
                  <label class="form-label">Tanggal Cek Medis Terakhir</label>
                  <input type="date" name="tanggal_cek_medis" class="form-control form-control-sm">
                </div>

                <div class="col-md-12">
                  <label class="form-label">Foto Ternak</label>
                  <input type="file" name="foto" class="form-control form-control-sm" accept="image/*" required>
                </div>

              </div>
            </div>

            <!-- Kontak Pemasok -->
            <div class="tab-pane fade" id="pemasok" role="tabpanel">
              <div class="row g-2">
                <div class="col-md-6">
                  <label class="form-label">Nama Pemasok</label>
                  <input type="text" name="nama_pemasok" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Nomor Telepon</label>
                  <input type="text" name="telepon_pemasok" class="form-control form-control-sm">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Alamat</label>
                  <textarea name="alamat_pemasok" class="form-control form-control-sm" rows="2"></textarea>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Hubungan</label>
                  <select name="hubungan_pemasok" class="form-select form-select-sm" required>
                    <option value="">Pilih</option>
                    <option value="Pihak Ketiga">Pihak Ketiga</option>
                    <option value="Pihak Berelasi">Pihak Berelasi</option>
                  </select>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer py-2">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
