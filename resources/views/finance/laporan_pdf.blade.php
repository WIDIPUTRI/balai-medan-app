<h2 style="text-align:center;">Laporan Keuangan</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="6">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jenis Transaksi</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{ $row->tanggal }}</td>
            <td>{{ $row->jenis_transaksi }}</td>
            <td>{{ number_format($row->jumlah, 0, ',', '.') }}</td>
            <td>{{ $row->keterangan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
