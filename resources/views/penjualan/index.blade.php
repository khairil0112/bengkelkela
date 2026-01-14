@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4">Data Transaksi</h2>

    <a href="{{ url('penjualan/create') }}" class="btn btn-primary mb-3">
        + Tambah Transaksi
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nota</th>
                <th>Kendaraan</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Mekanik</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($transaksi as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $t->nota }}</td>
                <td>{{ $t->kendaraan }}</td>
                <td>{{ $t->tanggal }}</td>
                <td>{{ $t->pelanggan->nama }}</td>
                <td>{{ $t->mekanik->namamk }}</td>

                <td>

                    <!-- DETAIL -->
                    <form action="{{ url('penjualan/detail', $t->id) }}"
                        method="POST" style="display:inline-block;">
                        @csrf
                        <button class="btn btn-primary btn-sm">Detail</button>
                    </form>

                    <!-- EDIT -->
                    <a href="{{ url('penjualan/edit', $t->id) }}"
                       class="btn btn-warning btn-sm">Edit</a>

                    <!-- CETAK NOTA (TAMBAHAN) -->
                    <a href="{{ route('penjualan.cetak', $t->id) }}"
                       class="btn btn-success btn-sm"
                       target="_blank">
                       Cetak
                    </a>

                    <!-- HAPUS -->
                    <form action="{{ url('penjualan/destroy', $t->id) }}"
                        method="POST" style="display:inline-block;"
                        onsubmit="return confirm('Yakin hapus data?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>

                </td>

            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
