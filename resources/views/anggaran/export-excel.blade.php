<table>
    <thead>
        <tr>
            <th colspan="7" style="text-align:center; font-weight:bold;">
                LAPORAN BULANAN ANGGARAN {{ strtoupper(\Carbon\Carbon::createFromDate($tahun, $bulan)->translatedFormat('F Y')) }}
            </th>
        </tr>
        <tr></tr>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Program</th>
            <th>Kegiatan</th>
            <th>Akun Belanja</th>
            <th>Uraian</th>
            <th>Nominal (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksis as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                <td>{{ $t->akunBelanja->kegiatan->program->nama ?? '-' }}</td>
                <td>{{ $t->akunBelanja->kegiatan->nama ?? '-' }}</td>
                <td>{{ $t->akunBelanja->nama ?? '-' }}</td>
                <td>{{ $t->uraian }}</td>
                <td style="text-align:right">{{ number_format($t->nominal, 2, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" style="text-align:right; font-weight:bold;">TOTAL</td>
            <td style="text-align:right; font-weight:bold;">{{ number_format($total, 2, ',', '.') }}</td>
        </tr>
    </tbody>
</table>
