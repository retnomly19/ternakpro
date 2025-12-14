

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 bg-white rounded-xl shadow-lg">

    
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center justify-center gap-2">
            <!-- Ikon Clipboard -->
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="text-blue-800" viewBox="0 0 16 16">
                <path d="M10 1.5v1h1a1 1 0 0 1 1 1V5H4V3.5a1 1 0 0 1 1-1h1v-1A1.5 1.5 0 0 1 7.5 0h1A1.5 1.5 0 0 1 10 1.5m-1 0v1h-2v-1a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5"/>
                <path d="M3 6v7a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V6zm9-1V3.5a2 2 0 0 0-2-2h-.057a2.501 2.501 0 0 0-4.886 0H5a2 2 0 0 0-2 2V5z"/>
            </svg>
            Detail Aktivitas Ternak
        </h2>
        <p class="text-sm text-blue-800 mt-2">
            <strong>Jenis Aktivitas:</strong> <?php echo e($aktivitas->jenisAktivitas->nama); ?> |
            <strong>Tanggal:</strong> <?php echo e($aktivitas->tanggal->format('Y-m-d')); ?> |
            <strong>Kandang:</strong> <?php echo e($aktivitas->kandang->nama); ?>

        </p>
    </div>

    
    <form action="<?php echo e(route('aktivitas.saveDetailTernak', $aktivitas->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg text-sm shadow-sm">
                <thead class="bg-gray-300 text-gray-800 font-semibold text-center">
                    <tr>
                        <th class="px-4 py-2 border">ID Ternak</th>
                        <th class="px-4 py-2 border">Jenis</th>
                        <th class="px-4 py-2 border">Ada/Tidak</th>
                        <th class="px-4 py-2 border">Kondisi</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Penanggung Jawab</th>
                        <th class="px-4 py-2 border">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $ternakKandang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-4 py-2 border text-center font-medium text-gray-700">
                            <?php echo e($t->id_ternak); ?>

                            <input type="hidden" name="id_ternak[]" value="<?php echo e($t->id_ternak); ?>">
                        </td>
                        <td class="px-4 py-2 border text-gray-600"><?php echo e($t->jenis); ?></td>

                        
                        <td class="px-4 py-2 border">
                            <select name="ada[]" class="w-full border-gray-300 rounded-md p-1.5 ada-select" data-index="<?php echo e($index); ?>" required>
                                <option value="ada">Ada</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </td>

                        
                        <td class="px-4 py-2 border">
                            <select name="kondisi[]" id="kondisi-<?php echo e($index); ?>" class="min-w-[5rem] border-gray-300 rounded-md p-1.5 kondisi-select" required>
                                <option value="sehat">Sehat</option>
                                <option value="sakit">Sakit</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </td>

                        
                        <td class="px-4 py-2 border">
                            <select name="status_detail[]" class="min-w-[5rem] border-gray-300 rounded-md p-1.5" required>
                                <option value="sudah">Sudah</option>
                                <option value="belum">Belum</option>
                            </select>
                        </td>

                        
                        <td class="px-4 py-2 border">
                            <select name="penanggung[]" class="w-full border-gray-300 rounded-md p-1.5 text-sm" required>
                                <option value="PT">PT</option>
                                <?php $__currentLoopData = $mitraList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e('mitra-' . $id); ?>"><?php echo e('mitra-' . $id . '-' . $nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>

                        
                        <td class="px-4 py-2 border">
                            <input type="text" name="keterangan[]" class="w-full border-gray-300 rounded-md p-1.5">
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        
        <div class="flex justify-end gap-3 mt-6">
            <a href="<?php echo e(route('aktivitas.index')); ?>" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow flex items-center gap-2 hover:bg-gray-600 transition">
                <!-- Ikon batal (X) -->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow flex items-center gap-2 hover:bg-blue-700 transition">
                <!-- Ikon simpan (disk) -->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                    <path d="M8.5 1h-5A1.5 1.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V5.5L11 1H8.5zM8 2h2.293L13 4.707V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2.5A.5.5 0 0 1 3.5 2H8z"/>
                    <path d="M5 10.5A1.5 1.5 0 0 1 6.5 9h3A1.5 1.5 0 0 1 11 10.5v3A1.5 1.5 0 0 1 9.5 15h-3A1.5 1.5 0 0 1 5 13.5v-3z"/>
                </svg>
                Simpan
            </button>
        </div>
    </form>
</div>


<script>
    document.querySelectorAll('.ada-select').forEach(select => {
        select.addEventListener('change', function () {
            const index = this.dataset.index;
            const kondisiSelect = document.getElementById('kondisi-' + index);
            kondisiSelect.innerHTML = '';

            if (this.value === 'ada') {
                kondisiSelect.innerHTML = `
                    <option value="sehat">Sehat</option>
                    <option value="sakit">Sakit</option>
                    <option value="lainnya">Lainnya</option>
                `;
            } else {
                kondisiSelect.innerHTML = `
                    <option value="dijual">Dijual</option>
                    <option value="mati">Mati</option>
                    <option value="lainnya">Lainnya</option>
                `;
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ternakpro2\resources\views/aktivitas/detail.blade.php ENDPATH**/ ?>