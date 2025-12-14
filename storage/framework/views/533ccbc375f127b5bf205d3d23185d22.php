

<?php $__env->startSection('header'); ?>
<h2 class="text-xl font-semibold text-gray-800 mb-4 text-center flex items-center justify-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
    </svg>
    Tambah Penjualan Ternak
</h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-6">

    
    <?php if($errors->any()): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm shadow">
            <ul class="list-disc pl-5 space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('penjualan_ternak.store')); ?>" method="POST" class="space-y-4 text-sm">
        <?php echo csrf_field(); ?>

        
        <div>
            <label class="block text-gray-700 mb-1 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/>
                </svg>
                ID
            </label>
            <input type="text" value="(otomatis)" readonly
                   class="w-full bg-gray-100 text-gray-500 border border-gray-300 rounded-lg px-3 py-2 shadow-sm cursor-not-allowed">
        </div>

        
        <div>
            <label for="tanggal" class="block text-gray-700 mb-1 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Tanggal
            </label>
            <input type="date" name="tanggal" id="tanggal" required value="<?php echo e(old('tanggal')); ?>"
                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
        </div>

        
        <div>
            <label for="harga_jual" class="block text-gray-700 mb-1 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-2.21 0-4 .79-4 2s1.79 2 4 2 4 .79 4 2-1.79 2-4 2m0-8V4m0 16v-4"/>
                </svg>
                Harga Jual
            </label>
            <input type="number" name="harga_jual" id="harga_jual" required value="<?php echo e(old('harga_jual')); ?>"
                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
        </div>

        
        <div>
            <label for="id_ternak" class="block text-gray-700 mb-1 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Jenis Ternak
            </label>
            <select name="id_ternak" id="id_ternak" required
                    class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                <option value="" disabled <?php echo e(old('id_ternak') ? '' : 'selected'); ?>>-- Pilih Ternak --</option>
                <?php $__currentLoopData = $ternakList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php echo e(old('id_ternak') == $id ? 'selected' : ''); ?>>
                        <?php echo e($label); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div>
            <label for="id_pelanggan" class="block text-gray-700 mb-1 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6h5V6H9v14h5z"/>
                </svg>
                Pelanggan
            </label>
            <select name="id_pelanggan" id="id_pelanggan" required
                    class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                <option value="" disabled <?php echo e(old('id_pelanggan') ? '' : 'selected'); ?>>-- Pilih Pelanggan --</option>
                <?php $__currentLoopData = $pelangganList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php echo e(old('id_pelanggan') == $id ? 'selected' : ''); ?>>
                        <?php echo e($nama); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div class="flex justify-end gap-2 pt-4">
            <a href="<?php echo e(route('penjualan_ternak.index')); ?>"
               class="inline-flex items-center gap-1 px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Batal
            </a>
            <button type="submit"
                    class="inline-flex items-center gap-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Simpan
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ternakpro2\resources\views/penjualan_ternak/create.blade.php ENDPATH**/ ?>