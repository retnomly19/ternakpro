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
        <p><strong>Jenis Aktivitas:</strong> {{ $aktivitas->jenisAktivitas->nama }}</p>
        <p><strong>Tanggal:</strong> {{ $aktivitas->tanggal->format('Y-m-d') }}</p>
        <p><strong>Kandang:</strong> {{ $aktivitas->kandang->nama }}</p>
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
            @foreach($aktivitas->ternakList as $index => $t)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $t->id_ternak }}</td>
                <td>{{ $t->jenis }}</td>
                <td>{{ $t->pivot->ada }}</td>
                <td>{{ $t->pivot->kondisi }}</td>
                <td>{{ ucfirst($t->pivot->status_detail ?? '-') }}</td>
                <td>{{ $t->pivot->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
