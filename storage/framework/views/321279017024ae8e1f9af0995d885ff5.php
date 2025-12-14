

<?php $__env->startSection('header'); ?>
    <h2 class="text-xl font-bold text-white"></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white p-6 rounded-xl shadow-lg">
    <div class="title">
        <div class="text-xl font-bold flex items-center gap-2 text-white-100 pb-4">
            Laporan Aktivitas
        </div>
    </div>

    
    <form method="GET" action="<?php echo e(route('laporan.aktivitas')); ?>" class="mb-6 no-print">
        <div class="flex flex-wrap justify-center items-center gap-4">
            
            <select name="bulan" class="border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                <option value="">Pilih Bulan</option>
                <?php for($m = 1; $m <= 12; $m++): ?>
                    <option value="<?php echo e($m); ?>" <?php echo e(request('bulan') == $m ? 'selected' : ''); ?>>
                        <?php echo e(DateTime::createFromFormat('!m', $m)->format('F')); ?>

                    </option>
                <?php endfor; ?>
            </select>

            
            <select name="tahun" class="border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                <option value="">Pilih Tahun</option>
                <?php for($y = now()->year; $y >= 2020; $y--): ?>
                    <option value="<?php echo e($y); ?>" <?php echo e(request('tahun') == $y ? 'selected' : ''); ?>>
                        <?php echo e($y); ?>

                    </option>
                <?php endfor; ?>
            </select>

            
            <select name="kandang" class="border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                <option value="">Pilih Kandang</option>
                <?php $__currentLoopData = $kandangList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($nama); ?>" <?php echo e(request('kandang') == $nama ? 'selected' : ''); ?>>
        <?php echo e($nama); ?>

    </option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>

            
            <div class="flex gap-2">
                <button type="submit" class="flex items-center gap-1 bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M9 14h6m-6 4h6"/>
                    </svg>
                    Filter
                </button>

                <a href="<?php echo e(route('laporan.aktivitas')); ?>" class="flex items-center gap-1 bg-gray-200 text-gray-800 px-3 py-2 rounded text-sm hover:bg-gray-300 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset
                </a>

                <button type="button" onclick="printDiv('printArea')" class="flex items-center gap-1 bg-green-600 text-white px-3 py-2 rounded text-sm hover:bg-green-700 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V4h12v5M6 14h12v7H6z"/>
                    </svg>
                    Print
                </button>
            </div>
        </div>
    </form>

    
    <div id="printArea">
        
        <?php if(request('bulan') || request('tahun') || request('kandang')): ?>
            <div class="text-center mb-6 text-gray-700 font-medium">
                <h3 class="text-lg font-bold mb-2">Laporan Aktivitas</h3>
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
                <thead class="bg-gray-400 text-center font-semibold text-gray-700">
                    <tr>
                        <th class="px-3 py-2">No</th>
                        <th class="px-3 py-2">Jenis Aktivitas</th>
                        <th class="px-3 py-2">Tanggal</th>
                        <th class="px-3 py-2">Kandang</th>
                        <th class="px-3 py-2">Keterangan</th>
                        <th class="px-3 py-2">Status</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t hover:bg-slate-50">
                            <td class="px-3 py-2 text-center"><?php echo e($index + 1); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->jenisAktivitas->nama ?? '-'); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->tanggal); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->kandang->nama ?? '-'); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->keterangan); ?></td>
                            <td class="px-3 py-2 italic"><?php echo e($item->status); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-3 py-4 text-center text-gray-500">Tidak ada data aktivitas ditemukan.</td>
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
    .no-print { display: none !important; } /* sembunyi filter & tombol */
    body { background: white !important; }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ternakpro2\resources\views/laporan/aktivitas.blade.php ENDPATH**/ ?>