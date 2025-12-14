

<?php $__env->startSection('header'); ?>
<h2 class="text-xl font-semibold text-white-800 mb-2 text-center">Tambah Pelanggan</h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto bg-white shadow rounded-xl p-5">

    <?php if($errors->any()): ?>
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-sm">
            <ul class="list-disc pl-4">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('pelanggan.store')); ?>" method="POST" class="space-y-3 text-sm">
        <?php echo csrf_field(); ?>

        
        <div>
            <label for="nama" class="block text-gray-700 mb-1">Nama</label>
            <input type="text" name="nama" id="nama" value="<?php echo e(old('nama')); ?>"
                   class="w-full border-gray-300 rounded-md px-3 py-1.5 focus:ring-pink-500 focus:border-pink-500">
        </div>

        
        <div>
            <label for="alamat" class="block text-gray-700 mb-1">Alamat</label>
            <textarea name="alamat" id="alamat" rows="2"
                      class="w-full border-gray-300 rounded-md px-3 py-1.5 focus:ring-pink-500 focus:border-pink-500"><?php echo e(old('alamat')); ?></textarea>
        </div>

        
        <div>
            <label for="telepon" class="block text-gray-700 mb-1">Telepon</label>
            <input type="text" name="telepon" id="telepon" value="<?php echo e(old('telepon')); ?>"
                   class="w-full border-gray-300 rounded-md px-3 py-1.5 focus:ring-pink-500 focus:border-pink-500">
        </div>

        
        <div>
            <label for="email" class="block text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>"
                   class="w-full border-gray-300 rounded-md px-3 py-1.5 focus:ring-pink-500 focus:border-pink-500">
        </div>

        
        <div>
            <label for="hubungan" class="block text-gray-700 mb-1">Hubungan</label>
            <select name="hubungan" id="hubungan"
                    class="w-full border-gray-300 rounded-md px-3 py-1.5 focus:ring-pink-500 focus:border-pink-500">
                <option value="" disabled selected>-- Pilih Hubungan --</option>
                <option value="Pihak Ketiga" <?php echo e(old('hubungan') == 'Pihak Ketiga' ? 'selected' : ''); ?>>Pihak Ketiga</option>
                <option value="Pihak Berelasi" <?php echo e(old('hubungan') == 'Pihak Berelasi' ? 'selected' : ''); ?>>Pihak Berelasi</option>
            </select>
        </div>

        
        <div class="flex justify-end gap-2 pt-3">
            <a href="<?php echo e(route('pelanggan.index')); ?>"
               class="px-3 py-1.5 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</a>
            <button type="submit"
                    class="px-4 py-1.5 bg-pink-600 text-white rounded hover:bg-pink-700 shadow">Simpan</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ternakpro2\resources\views/setting/pelanggan/create.blade.php ENDPATH**/ ?>