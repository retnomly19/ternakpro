

<?php $__env->startSection('header'); ?>
<h2 class="text-2xl font-bold text-white-800 mb-4 text-center"></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto py-6">

    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 shadow-sm">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <div class="title">
        <div class="text-xl font-bold flex items-center gap-2 text-white-100 pb-4">
            Data Pemasok
        </div>
    </div>

    
    <div class="flex justify-start mb-4">
        <a href="<?php echo e(route('pemasok.create')); ?>"
           class="inline-flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-full shadow hover:bg-green-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Pemasok
        </a>
    </div>

    
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border px-3 py-2">ID</th>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">Alamat</th>
                    <th class="border px-3 py-2">Telepon</th>
                    <th class="border px-3 py-2">Email</th>
                    <th class="border px-3 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $pemasok; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <tr class="hover:bg-pink-50">
        <td class="border px-3 py-2 text-center text-gray-600"><?php echo e($item->id); ?></td>
        <td class="border px-3 py-2"><?php echo e($item->nama); ?></td>
        <td class="border px-3 py-2"><?php echo e($item->alamat); ?></td>
        <td class="border px-3 py-2"><?php echo e($item->telepon); ?></td>
        <td class="border px-3 py-2"><?php echo e($item->email); ?></td>
        <td class="border px-3 py-2 text-center flex justify-center gap-3">
            
            <a href="<?php echo e(route('pemasok.edit', $item->id)); ?>"
               class="text-yellow-500 hover:text-yellow-600" title="Edit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M18.5 2.5l3 3L12 15l-3 1 1-3 9.5-9.5z" />
                </svg>
            </a>

            
            <form action="<?php echo e(route('pemasok.destroy', $item->id)); ?>" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="text-red-500 hover:text-red-600" title="Hapus">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </form>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
        <td colspan="7" class="border px-3 py-4 text-center text-gray-500">Tidak ada data</td>
    </tr>
    <?php endif; ?>
</tbody>

        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ternakpro2\resources\views/setting/pemasok/index.blade.php ENDPATH**/ ?>