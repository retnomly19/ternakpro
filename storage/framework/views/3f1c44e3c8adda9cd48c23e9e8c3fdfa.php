

<?php $__env->startSection('header'); ?>
<h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">✚ Tambah Kandang</h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto py-6">
    <div class="bg-white shadow rounded-lg p-6">
       

        <form action="<?php echo e(route('kandang.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-semibold text-gray-700">ID Kandang</label>
                    <input type="text" name="id_kandang" value="<?php echo e(old('id_kandang')); ?>" class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Nama Kandang</label>
                    <input type="text" name="nama" value="<?php echo e(old('nama')); ?>" class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Lokasi (Desa)</label>
                    <input type="text" name="lokasi" value="<?php echo e(old('lokasi')); ?>" class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Penanggung Jawab</label>
                    <input type="text" name="penanggung_jawab" value="<?php echo e(old('penanggung_jawab')); ?>" class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Ternak</label>
                    <div class="border rounded p-3 bg-gray-50">
                        <select name="jenis_ternak" class="w-full px-3 py-2 rounded" required>
                            <option value="">-- Pilih Jenis Ternak --</option>
                            <?php $__currentLoopData = $kategoriTernak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kt->nama); ?>" <?php if(old('jenis_ternak') == $kt->nama): echo 'selected'; endif; ?>><?php echo e($kt->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

            </div>

            <div class="mt-6 text-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Kandang</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ternakpro2\resources\views/kandang/create.blade.php ENDPATH**/ ?>