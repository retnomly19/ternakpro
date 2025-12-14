<!DOCTYPE html>
<html>
<head>
    <title>🖨 Cetak Aktivitas</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        h2, .info { text-align: center; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #894343ff; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        @media print {
            body { margin: 0; }
        }
    </style>
</head>
<body onload="window.print()">

    <h2>🗐 Detail Aktivitas Ternak</h2>
    <div class="info">
        <p><strong>Jenis Aktivitas:</strong> <?php echo e($aktivitas->jenisAktivitas->nama); ?></p>
        <p><strong>Tanggal:</strong> <?php echo e($aktivitas->tanggal->format('Y-m-d')); ?></p>
        <p><strong>Kandang:</strong> <?php echo e($aktivitas->kandang->nama); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Ternak</th>
                <th>Jenis</th>
                <th>Ada/tidak</th>
                <th>Kondisi</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $aktivitas->ternakList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($t->id_ternak); ?></td>
                <td><?php echo e($t->jenis); ?></td>
                <td><?php echo e($t->pivot->ada); ?></td>
                <td><?php echo e($t->pivot->kondisi); ?></td>
                <td><?php echo e(ucfirst($t->pivot->status_detail ?? '-')); ?></td>
                <td><?php echo e($t->pivot->keterangan); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</body>
</html>
<?php /**PATH C:\laragon\www\ternakpro2\resources\views/aktivitas/print.blade.php ENDPATH**/ ?>