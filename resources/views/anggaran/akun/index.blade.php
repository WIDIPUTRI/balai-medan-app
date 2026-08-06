@extends('layouts.app')
@section('content')
<div class="container">
    <h3>📘 Data Akun Belanja</h3>
    <a href="{{ route('akun-belanja.create') }}" class="btn btn-primary mb-3">+ Tambah Akun</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Komponen</th>
                <th>Pagu</th>
                <th>Realisasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($akunBelanjas as $a)
            <tr>
                <td>{{ $a->kode }}</td>
                <td>{{ $a->nama }}</td>
                <td>{{ $a->komponen->nama }}</td>
                <td>Rp{{ number_format($a->pagu, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($a->realisasi, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('akun-belanja.edit', $a) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('akun-belanja.destroy', $a) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <th>Status</th>
...
<td>{{ $a->status }}</td>


    {{ $akunBelanjas->links() }}
</div>
@endsection
