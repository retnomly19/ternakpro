

<?php $__env->startSection('header'); ?>
        
    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white p-6 rounded-xl shadow-lg">
    <div class="title">
        <div class="text-xl font-bold flex items-center gap-2 text-white-100 pb-4">
            Laporan Kematian Ternak
        </div>
    </div>

    
    <form method="GET" action="<?php echo e(route('laporan.kematian')); ?>" class="mb-6 no-print">
        <div class="flex flex-wrap justify-center items-center gap-4">
            
            
            <select name="bulan" class="border rounded px-3 py-2 text-sm shadow-sm">
                <option value="">Pilih Bulan</option>
                <?php for($m = 1; $m <= 12; $m++): ?>
                    <option value="<?php echo e($m); ?>" <?php echo e(request('bulan') == $m ? 'selected' : ''); ?>>
                        <?php echo e(DateTime::createFromFormat('!m', $m)->format('F')); ?>

                    </option>
                <?php endfor; ?>
            </select>

            
            <select name="tahun" class="border rounded px-3 py-2 text-sm shadow-sm">
                <option value="">Pilih Tahun</option>
                <?php for($y = now()->year; $y >= 2020; $y--): ?>
                    <option value="<?php echo e($y); ?>" <?php echo e(request('tahun') == $y ? 'selected' : ''); ?>>
                        <?php echo e($y); ?>

                    </option>
                <?php endfor; ?>
            </select>

            
            <select name="kandang" class="border rounded px-3 py-2 text-sm shadow-sm">
                <option value="">Pilih Kandang</option>
                <?php $__currentLoopData = $kandangList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php echo e(request('kandang') == $id ? 'selected' : ''); ?>>
                        <?php echo e($nama); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            
            <div class="flex gap-2">
                <button type="submit" 
                    class="flex items-center gap-1 bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700 shadow">
                    
                    Filter
                </button>
                <a href="<?php echo e(route('laporan.kematian')); ?>" 
                   class="flex items-center gap-1 bg-gray-200 text-gray-800 px-3 py-2 rounded text-sm hover:bg-gray-300 shadow">
                    
                    Reset
                </a>
                <button type="button" onclick="printDiv('printArea')" 
                    class="flex items-center gap-1 bg-green-600 text-white px-3 py-2 rounded text-sm hover:bg-green-700 shadow">
                    
                    Print
                </button>
            </div>
        </div>
    </form>

    
    <div id="printArea">
        
        <?php if(request('bulan') || request('tahun') || request('kandang')): ?>
            <div class="text-center mb-6 text-gray-700 font-medium">
                <h3 class="text-lg font-bold mb-2">Laporan Kematian Ternak</h3>
                <p>
                    <?php if(request('bulan')): ?>
                        Bulan: <span class="font-semibold"><?php echo e(DateTime::createFromFormat('!m', request('bulan'))->format('F')); ?></span>
                    <?php endif; ?>
                    <?php if(request('tahun')): ?>
                        , Tahun: <span class="font-semibold"><?php echo e(request('tahun')); ?></span>
                    <?php endif; ?>
                    <?php if(request('kandang')): ?>
                        , Kandang: <span class="font-semibold"><?php echo e($kandangList[request('kandang')] ?? 'Semua Kandang'); ?></span>
                    <?php else: ?>
                        , Semua Kandang
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>

        
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-200 rounded-lg">
                <thead class="bg-blue-100 text-gray-700 font-semibold text-center">
                    <tr>
                        <th class="px-3 py-2">No</th>
                        <th class="px-3 py-2">Tanggal Kematian</th>
                        <th class="px-3 py-2">ID Ternak</th>
                        <th class="px-3 py-2">Jenis Ternak</th>
                        <th class="px-3 py-2">Kandang</th>
                        <th class="px-3 py-2">Penanggung Jawab</th>
                        <th class="px-3 py-2">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t hover:bg-slate-50">
                            <td class="px-3 py-2 text-center"><?php echo e($index + 1); ?></td>
                            <td class="px-3 py-2"><?php echo e($row['tanggal']); ?></td>
                            <td class="px-3 py-2"><?php echo e($row['id_ternak']); ?></td>
                            <td class="px-3 py-2"><?php echo e($row['jenis']); ?></td>
                            <td class="px-3 py-2"><?php echo e($row['kandang']); ?></td>
                            <td class="px-3 py-2 text-center"><?php echo e($row['penanggung_jawab']); ?></td>
                            <td class="px-3 py-2"><?php echo e($row['keterangan']); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-3 py-4 text-center text-gray-500">Tidak ada data kematian ternak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    function printDiv(divId) {
        var content = document.getElementById(divId).innerHTML;
        var original = document.body.innerHTML;
        document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = original;
    }
</script>


<style>
@media print {
    .no-print { display: none !important; }
    body { background: white !important; }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ternakpro2\resources\views/laporan/kematian.blade.php ENDPATH**/ ?>