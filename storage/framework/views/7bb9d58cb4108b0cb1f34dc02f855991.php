

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6 max-w-5xl">

    
    <h2 class="text-2xl font-bold text-gray-900 mb-4">
        Daftar Kategori Ternak
    </h2>

    
    <div class="flex justify-start mb-4">
        <a href="<?php echo e(route('kategori_ternak.create')); ?>"
           class="inline-flex items-center gap-3 bg-blue-600 text-white px-6 py-3 
                  rounded-full shadow-lg hover:bg-blue-700 transition text-lg font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kategori
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-800 p-2 rounded mb-3">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full text-sm text-gray-800">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 w-16 text-left">No</th>
                    <th class="px-4 py-3 text-left">Nama Kategori</th>
                    <th class="px-4 py-3 w-40 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 border-t">
                    <td class="px-4 py-2">
                        <?php echo e($loop->iteration + ($kategori->currentPage() - 1) * $kategori->perPage()); ?>

                    </td>

                    <td class="px-4 py-2"><?php echo e($k->nama); ?></td>

                    <td class="px-4 py-2">
                        <div class="flex justify-center items-center gap-2">
                            <a href="<?php echo e(route('kategori_ternak.edit', $k->id)); ?>"
                               class="px-3 py-1 bg-yellow-400 text-white rounded-full hover:bg-yellow-500 transition">
                                ✎
                            </a>

                            <form action="<?php echo e(route('kategori_ternak.destroy', $k->id)); ?>" method="POST"
                                  onsubmit="return confirm('Yakin ingin hapus kategori ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded-full hover:bg-red-700 transition">
                                    ⌦
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3" class="px-4 py-3 text-center text-gray-500">
                        Belum ada kategori
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="mt-4">
        <?php echo e($kategori->links()); ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ternakpro2\resources\views/kategori_ternak/index.blade.php ENDPATH**/ ?>