

<?php $__env->startSection('header'); ?>
    <h2 class="text-xl font-bold text-white"></h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white p-6 rounded shadow">
    <div class="title">
        <div class="text-xl font-bold flex items-center gap-2 text-white-100 pb-4">
            Laporan Persediaan Ternak
        </div>
    </div>

    
    <form method="GET" action="<?php echo e(route('laporan.persediaan')); ?>" class="mb-6 no-print">
        <div class="flex flex-wrap justify-center items-center gap-4">

            
            <select name="kandang" class="border rounded px-3 py-2 text-sm">
    <option value="">Pilih Kandang</option>
    <?php $__currentLoopData = $kandangList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($nama); ?>" <?php echo e(request('kandang') == $nama ? 'selected' : ''); ?>>
            <?php echo e($nama); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>


            
            <select name="bulan" class="border rounded px-3 py-2 text-sm">
                <option value="">Pilih Bulan</option>
                <?php for($m = 1; $m <= 12; $m++): ?>
                    <option value="<?php echo e($m); ?>" <?php echo e(request('bulan') == $m ? 'selected' : ''); ?>>
                        <?php echo e(DateTime::createFromFormat('!m', $m)->format('F')); ?>

                    </option>
                <?php endfor; ?>
            </select>

            
            <select name="tahun" class="border rounded px-3 py-2 text-sm">
                <option value="">Pilih Tahun</option>
                <?php for($y = now()->year; $y >= 2020; $y--): ?>
                    <option value="<?php echo e($y); ?>" <?php echo e(request('tahun') == $y ? 'selected' : ''); ?>>
                        <?php echo e($y); ?>

                    </option>
                <?php endfor; ?>
            </select>

            
            <div class="flex gap-2">
                <button type="submit" class="flex items-center gap-1 bg-blue-600 text-white px-2 py-1 rounded text-sm hover:bg-blue-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18v2H3V4zM3 8h18v12a1 1 0 01-1 1H4a1 1 0 01-1-1V8z"/>
                    </svg>
                    Filter
                </button>
                <a href="<?php echo e(route('laporan.persediaan')); ?>" class="flex items-center gap-1 bg-gray-200 text-gray-800 px-3 py-2 rounded text-sm hover:bg-gray-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset
                </a>
                <div class="flex justify-end mb-4 no-print">
        <button onclick="printDiv('printArea')" class="flex items-center gap-1 bg-green-600 text-white px-3 py-2 rounded text-sm hover:bg-green-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9v6h12V9H6zm0 0V4h12v5M6 15v5h12v-5"/>
            </svg>
            Cetak
        </button>
    </div>
            </div>
        </div>
    </form>

    

    
    <div id="printArea">
        
        <?php if(request('bulan') || request('tahun') || request('kandang')): ?>
            <div class="text-center mb-6 text-gray-700 font-medium">
                <h3 class="text-lg font-bold mb-2">Laporan Persediaan Ternak</h3>
                <p>
                    <?php if(request('bulan')): ?>
                        Bulan: <span class="font-semibold"><?php echo e(DateTime::createFromFormat('!m', request('bulan'))->format('F')); ?></span>
                    <?php endif; ?>
                    <?php if(request('tahun')): ?>
                        , Tahun: <span class="font-semibold"><?php echo e(request('tahun')); ?></span>
                    <?php endif; ?>
                
                    <?php if(request('kandang')): ?>
                        , Kandang: <span class="font-semibold"><?php echo e(request('kandang')); ?></span>
                    <?php else: ?>
                        , Kandang: <span class="text-gray-500">Semua Kandang</span>
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>

        
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-200 rounded-lg">
                <thead class="bg-blue-100 text-center font-semibold text-gray-700">
                    <tr>
                        <th class="px-3 py-2">No</th>
                        <th class="px-3 py-2">ID Ternak</th>
                        <th class="px-3 py-2">Kategori</th>
                        <th class="px-3 py-2">Jenis</th>
                        <th class="px-3 py-2">Lokasi</th>
                        <th class="px-3 py-2">Umur (bln)</th>
                        <th class="px-3 py-2">Jenis Kelamin</th>
                        <th class="px-3 py-2">Penanggung Jawab</th>
                        <th class="px-3 py-2">Pemasok</th>
                        <th class="px-3 py-2">Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t hover:bg-slate-50">
                            <td class="px-3 py-2 text-center"><?php echo e($index + 1); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->id_ternak); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->kategori); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->jenis); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->lokasi); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->umur); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->jenis_kelamin); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->penanggung_jawab ?? '-'); ?></td>
                            <td class="px-3 py-2"><?php echo e($item->pemasok->nama ?? '-'); ?></td>
                            <td class="px-3 py-2"><?php echo e(\Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="10" class="px-3 py-4 text-center text-gray-500">Tidak ada data ternak ditemukan.</td>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ternakpro2\resources\views/laporan/persediaan.blade.php ENDPATH**/ ?>