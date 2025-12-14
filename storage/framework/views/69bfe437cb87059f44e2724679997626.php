

<?php $__env->startSection('content'); ?>
<div class="p-6 bg-white rounded-2xl shadow-lg">

    
    <?php if(session('success')): ?>
        <div x-data="{ show: true }" x-show="show"
             x-init="setTimeout(() => show = false, 3000)"
             class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow-sm text-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <div class="title">
        <div class="text-xl font-bold flex items-center gap-2 text-white-100 pb-4">
            Aktivitas
        </div>
    </div>

    
    <div class="flex flex-wrap items-center gap-2 mb-6">
        <button id="btnTambah"
            class="inline-flex items-center gap-1 px-4 py-2 bg-blue-800 text-white text-sm font-semibold rounded-full hover:bg-blue-700 shadow transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Aktivitas
        </button>

        <input type="text" placeholder="Cari aktivitas..." id="searchInput"
               class="border px-3 py-2 rounded-full text-sm shadow-sm w-44 focus:ring-blue-500 focus:border-blue-500"
               onkeyup="filterTable()">

        <select id="filterJenis"
                class="border px-3 py-2 rounded-full text-sm shadow-sm w-44 focus:ring-blue-500 focus:border-blue-500"
                onchange="filterTable()">
            <option value="">Jenis Aktivitas</option>
            <?php $__currentLoopData = $jenisAktivitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($jenis->id); ?>"><?php echo e($jenis->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select id="filterKandang"
                class="border px-3 py-2 rounded-full text-sm shadow-sm w-44 focus:ring-blue-500 focus:border-blue-500"
                onchange="filterTable()">
            <option value="">Kandang</option>
            <?php $__currentLoopData = $kandang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="overflow-x-auto">
        <table id="aktivitasTable" class="w-full border-separate border-spacing-0 rounded-xl overflow-hidden shadow-sm">
            <thead>
                <tr class="bg-gray-300 text-gray-700 text-sm uppercase">
                    <th class="px-4 py-3 text-center">No</th>
                    <th class="px-4 py-3 text-center">Jenis Aktivitas</th>
                    <th class="px-4 py-3 text-center">Tanggal</th>
                    <th class="px-4 py-3 text-center">Kandang</th>
                    <th class="px-4 py-3 text-center">Keterangan</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800">
                <?php $__currentLoopData = $aktivitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-blue-100 border-t">
                    <td class="px-4 py-2 text-center"><?php echo e($index + 1); ?></td>
                    <td class="px-4 py-2 text-center"><?php echo e($item->jenisAktivitas->nama ?? '-'); ?></td>
                    <td class="px-4 py-2 text-center"><?php echo e($item->tanggal->format('Y-m-d')); ?></td>
                    <td class="px-4 py-2 text-center"><?php echo e($item->kandang->nama ?? $item->id_kandang); ?></td>
                    <td class="px-4 py-2 text-center"><?php echo e($item->keterangan ?? '-'); ?></td>
                    <td class="px-4 py-2 text-center">
                        <?php if($item->status == 'on process'): ?>
                            <a href="<?php echo e(route('aktivitas.showDetail', $item->id)); ?>"
                               class="inline-block px-3 py-1 rounded-full bg-yellow-500 text-white text-xs font-semibold hover:bg-yellow-600 transition">
                                <?php echo e($item->status_text); ?>

                            </a>
                        <?php else: ?>
                            <?php
                                $statusClass = match($item->status) {
                                    'on schedule' => 'bg-gray-400 text-white',
                                    'completed'   => 'bg-blue-500 text-white',
                                    default       => 'bg-gray-200 text-black',
                                };
                            ?>
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold <?php echo e($statusClass); ?>">
                                <?php echo e($item->status_text); ?>

                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-2 text-center">
                        <div class="flex justify-center items-center gap-2">
                            
                            <form action="<?php echo e(route('aktivitas.destroy', $item->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>

                            
                            <a href="<?php echo e(route('aktivitas.edit', $item->id)); ?>" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/>
                                </svg>
                            </a>

                            
                            <?php if($item->status == 'completed'): ?>
                                <a href="<?php echo e(route('aktivitas.print', $item->id)); ?>" class="text-blue-500 hover:text-blue-700" title="Print">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18h12v4H6v-4z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 14h12v4H6z"/>
                                    </svg>
                                </a>
                            <?php else: ?>
                                <span class="text-gray-400 cursor-not-allowed" title="Print tidak tersedia">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18h12v4H6v-4z"/>
                                    </svg>
                                </span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    
    <div id="modalTambah" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 <?php echo e($errors->any() ? '' : 'hidden'); ?>">
        <div class="bg-white p-6 rounded-2xl shadow-lg w-96 relative z-50">
            <h3 class="text-lg font-semibold mb-4 text-center flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Aktivitas
            </h3>

            <?php if($errors->any()): ?>
                <div class="text-red-600 mb-3 text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('aktivitas.store')); ?>" method="POST" class="space-y-3">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="w-full border rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required value="<?php echo e(old('tanggal')); ?>">
                </div>

                <div>
                    <label for="id_kandang" class="block text-sm font-medium text-gray-700 mb-1">Kandang</label>
                    <select name="id_kandang" id="id_kandang" class="w-full border rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">-- pilih --</option>
                        <?php $__currentLoopData = $kandang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($k->id_kandang); ?>" <?php echo e(old('id_kandang') == $k->id_kandang ? 'selected' : ''); ?>>
                                <?php echo e($k->id_kandang); ?> - <?php echo e($k->nama); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label for="jenis_aktivitas_id" class="block text-sm font-medium text-gray-700 mb-1">Jenis Aktivitas</label>
                    <select name="jenis_aktivitas_id" id="jenis_aktivitas_id" class="w-full border rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">-- pilih --</option>
                        <?php $__currentLoopData = $jenisAktivitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($jenis->id); ?>" <?php echo e(old('jenis_aktivitas_id') == $jenis->id ? 'selected' : ''); ?>>
                                <?php echo e($jenis->nama); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="w-full border rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" value="<?php echo e(old('keterangan')); ?>">
                </div>

                <input type="hidden" name="status" value="on schedule">

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" id="btnBatal" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    document.getElementById('btnTambah').addEventListener('click', function(){
        document.getElementById('modalTambah').classList.remove('hidden');
    });
    document.getElementById('btnBatal').addEventListener('click', function(){
        document.getElementById('modalTambah').classList.add('hidden');
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ternakpro2\resources\views/aktivitas/index.blade.php ENDPATH**/ ?>