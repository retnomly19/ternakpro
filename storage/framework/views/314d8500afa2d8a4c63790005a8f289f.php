

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-3 max-w-4xl">
    <div class="text-center mb-3">
        <h1 class="text-2xl font-semibold">Tambah Data Ternak</h1>
    </div>

    <?php if($errors->any()): ?>
        <div class="bg-red-100 p-2 rounded mb-3">
            <ul class="text-sm text-red-700 list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-sm rounded-lg">
        <form action="<?php echo e(route('ternak.store')); ?>" method="POST" enctype="multipart/form-data" id="ternakForm">
            <?php echo csrf_field(); ?>

            <div class="flex justify-center mb-3 pt-3">
                <button type="button" id="tabInformasiBtn" class="tab-btn px-4 py-1 text-sm font-medium bg-blue-600 text-white rounded-t">Informasi Umum</button>
                <button type="button" id="tabPemasokBtn" class="tab-btn px-4 py-1 text-sm font-medium ml-2 bg-gray-100 text-gray-700 rounded-t">Kontak Pemasok</button>
            </div>

            
            <div id="tabInformasi" class="tab-pane px-4 py-4">
                <div class="grid grid-cols-1 md:grid-cols-10 gap-4">
                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium mb-1">ID Ternak <span class="text-red-600">*</span></label>
                        <input type="text" name="id_ternak" value="<?php echo e(old('id_ternak')); ?>" required class="w-full border rounded px-3 py-2 text-sm">
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium mb-1">Harga Beli <span class="text-red-600">*</span></label>
                        <input type="number" name="harga_beli" value="<?php echo e(old('harga_beli')); ?>" step="0.01" min="0" required class="w-full border rounded px-3 py-2 text-sm">
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium mb-1">Kategori <span class="text-red-600">*</span></label>
                        <select name="kategori" id="kategoriSelect" class="w-full border rounded px-3 py-2 text-sm">
                            <option value="">-- Pilih Kategori --</option>
                            <?php if(isset($kategoriList)): ?>
                                <?php $__currentLoopData = $kategoriList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->nama); ?>" <?php if(old('kategori')==$cat->nama): echo 'selected'; endif; ?>><?php echo e($cat->nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <?php $__currentLoopData = \App\Models\KategoriTernak::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->nama); ?>" <?php if(old('kategori')==$cat->nama): echo 'selected'; endif; ?>><?php echo e($cat->nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <option value="__new">+ Tambah Kategori Baru</option>
                        </select>
                        <input type="text" name="kategori_baru" id="kategoriBaruInput" value="<?php echo e(old('kategori_baru')); ?>" placeholder="Kategori baru..." class="w-full border rounded px-3 py-2 text-sm mt-2 hidden">
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium mb-1">Kondisi <span class="text-red-600">*</span></label>
                        <select name="kondisi" required class="w-full border rounded px-3 py-2 text-sm">
                            <option value="">-- Pilih --</option>
                            <option value="Sehat" <?php if(old('kondisi')=='Sehat'): echo 'selected'; endif; ?>>Sehat</option>
                            <option value="Sakit" <?php if(old('kondisi')=='Sakit'): echo 'selected'; endif; ?>>Sakit</option>
                        </select>
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium mb-1">Jenis Ternak <span class="text-red-600">*</span></label>
                        <input type="text" name="jenis" value="<?php echo e(old('jenis')); ?>" required class="w-full border rounded px-3 py-2 text-sm">
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium mb-1">Lokasi <span class="text-red-600">*</span></label>
                        <select name="lokasi" required class="w-full border rounded px-3 py-2 text-sm">
                            <option value="">-- Pilih Lokasi --</option>
                            <?php $__currentLoopData = ['Kandang A','Kandang B','Kandang C','Kandang D']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($loc); ?>" <?php if(old('lokasi')==$loc): echo 'selected'; endif; ?>><?php echo e($loc); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium mb-1">Umur (bulan) <span class="text-red-600">*</span></label>
                        <input type="number" name="umur" min="0" value="<?php echo e(old('umur')); ?>" required class="w-full border rounded px-3 py-2 text-sm">
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium mb-1">Tanggal Masuk <span class="text-red-600">*</span></label>
                        <input type="date" name="tanggal_masuk" value="<?php echo e(old('tanggal_masuk')); ?>" required class="w-full border rounded px-3 py-2 text-sm">
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium mb-1">Jenis Kelamin <span class="text-red-600">*</span></label>
                        <select name="jenis_kelamin" required class="w-full border rounded px-3 py-2 text-sm">
                            <option value="">-- Pilih --</option>
                            <option value="Jantan" <?php if(old('jenis_kelamin')=='Jantan'): echo 'selected'; endif; ?>>Jantan</option>
                            <option value="Betina" <?php if(old('jenis_kelamin')=='Betina'): echo 'selected'; endif; ?>>Betina</option>
                        </select>
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium mb-1">Foto</label>
                        <input type="file" name="foto" accept="image/*" class="w-full text-sm">
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium mb-1">Daftar Vaksinasi</label>
                        <input type="text" name="vaksinasi" value="<?php echo e(old('vaksinasi')); ?>" placeholder="Contoh: Rabies, Cacar" class="w-full border rounded px-3 py-2 text-sm">
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-sm font-medium mb-1">Tanggal Cek Medis Terakhir</label>
                        <input type="date" name="cek_medis_terakhir" value="<?php echo e(old('cek_medis_terakhir')); ?>" class="w-full border rounded px-3 py-2 text-sm">
                    </div>
                </div>
                    <div>
                        <label for="penanggung_jawab" class="block text-gray-700 mb-1">Penanggung Jawab Perawatan</label>
                        <select name="penanggung_jawab" id="penanggung_jawab" required
                            class="w-full border-gray-300 rounded-md px-3 py-1.5 focus:ring-pink-500 focus:border-pink-500">
                        <option value="" disabled selected>-- Pilih Penanggung Jawab --</option>
                        <option value="PT" <?php echo e(old('penanggung_jawab', $ternak->penanggung_jawab ?? '') == 'PT' ? 'selected' : ''); ?>>PT</option>
                        <?php $__currentLoopData = $mitraList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $value = 'mitra-' . $id;
                                $label = $value . '-' . $nama;
                            ?>
                        <option value="<?php echo e($value); ?>" <?php echo e(old('penanggung_jawab', $ternak->penanggung_jawab ?? '') == $value ? 'selected' : ''); ?>>
                            <?php echo e($label); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

                <div class="mt-3 text-right">
                    <button type="button" id="toPemasok" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Lanjut</button>
                </div>
            </div>

            
            <div id="tabPemasok" class="tab-pane hidden px-4 py-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <div>
            <label class="block text-sm font-medium mb-1">Pilih Pemasok</label>
            <select id="pemasokSelect" class="w-full border rounded px-3 py-2 text-sm">
                <option value="">-- Pilih dari data --</option>
                <?php $__currentLoopData = $pemasokList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pemasok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($pemasok->id); ?>"
                        data-nama="<?php echo e($pemasok->nama); ?>"
                        data-telepon="<?php echo e($pemasok->telepon); ?>"
                        data-email="<?php echo e($pemasok->email); ?>"
                        data-alamat="<?php echo e($pemasok->alamat); ?>"
                        data-hubungan="<?php echo e($pemasok->hubungan); ?>">
                        <?php echo e($pemasok->nama); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div>
            <label class="block text-sm font-medium mb-1">Nama Pemasok</label>
            <input type="text" name="nama_pemasok" id="namaPemasok" value="<?php echo e(old('nama_pemasok')); ?>"
                   class="w-full border rounded px-3 py-2 text-sm">
        </div>

        
        <div>
            <label class="block text-sm font-medium mb-1">Telepon Pemasok</label>
            <input type="text" name="telepon_pemasok" id="teleponPemasok" value="<?php echo e(old('telepon_pemasok')); ?>"
                   class="w-full border rounded px-3 py-2 text-sm">
        </div>

        
        <div>
            <label class="block text-sm font-medium mb-1">Email Pemasok</label>
            <input type="email" name="email_pemasok" id="emailPemasok" value="<?php echo e(old('email_pemasok')); ?>"
                   class="w-full border rounded px-3 py-2 text-sm">
        </div>

        
        <div>
            <label class="block text-sm font-medium mb-1">Alamat Pemasok</label>
            <input type="text" name="alamat_pemasok" id="alamatPemasok" value="<?php echo e(old('alamat_pemasok')); ?>"
                   class="w-full border rounded px-3 py-2 text-sm">
        </div>

        
        <div>
            <label class="block text-sm font-medium mb-1">Hubungan</label>
            <input type="text" name="hubungan_pemasok" id="hubunganPemasok" value="<?php echo e(old('hubungan_pemasok')); ?>"
                   class="w-full border rounded px-3 py-2 text-sm">
        </div>
    </div>

    
    <div class="mt-4 flex justify-between">
        <button type="button" id="toInformasi" class="bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm">Sebelumnya</button>
        <div class="flex items-center gap-2">
            <button type="reset" class="bg-gray-100 text-gray-700 px-3 py-1 rounded text-sm">Reset</button>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm">Simpan</button>
        </div>
    </div>
</div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('pemasokSelect');
    const nama = document.getElementById('namaPemasok');
    const telepon = document.getElementById('teleponPemasok');
    const email = document.getElementById('emailPemasok');
    const alamat = document.getElementById('alamatPemasok');
    const hubungan = document.getElementById('hubunganPemasok');

    select.addEventListener('change', function () {
        const selected = select.options[select.selectedIndex];
        nama.value = selected.dataset.nama || '';
        telepon.value = selected.dataset.telepon || '';
        email.value = selected.dataset.email || '';
        alamat.value = selected.dataset.alamat || '';
        hubungan.value = selected.dataset.hubungan || '';
    });
});
</script>

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
        const required = ['id_ternak','jenis','kategori','umur','jenis_kelamin','harga_beli','kondisi','lokasi','tanggal_masuk'];
        let ok = true;
        for (let name of required) {
            const el = document.querySelector(`[name="${name}"]`);
            if (!el || !el.value) { ok = false; break; }
        }
        if (!ok) { alert('Lengkapi semua field wajib di Informasi Umum.'); showInformasi(); return; }
        showPemasok();
    });

    toInformasi.addEventListener('click', showInformasi);

    // kategori baru toggle
    const kategoriSelect = document.getElementById('kategoriSelect');
    const kategoriBaruInput = document.getElementById('kategoriBaruInput');
    kategoriSelect.addEventListener('change', function() {
        if (this.value === '__new') { kategoriBaruInput.classList.remove('hidden'); kategoriBaruInput.required = true; }
        else { kategoriBaruInput.classList.add('hidden'); kategoriBaruInput.required = false; kategoriBaruInput.value = ''; }
    });
});
</script>
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ternakpro2\resources\views/ternak/create.blade.php ENDPATH**/ ?>