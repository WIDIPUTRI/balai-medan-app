<!DOCTYPE html>
<html>

<head>
    <title>Data Pegawai</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>

    <h2 style="text-align: center;">Laporan Data Pegawai</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>TTL</th>
                <th>Pendidikan</th>
                <th>Pangkat</th>
                <th>Jabatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pegawai as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->gender }}</td>
                    <td>{{ $item->birth_place }}, {{ $item->birth_date }}</td>
                    <td>{{ $item->education }}</td>
                    <td>{{ $item->rank }}</td>
                    <td>{{ $item->position }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>