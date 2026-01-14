@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4">Data Pelanggan</h2>

    <a href="{{ url('pelanggan/create') }}" class="btn btn-primary mb-3">+ Tambah Pelanggan</a>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Kode</th>
                        <th>No Plat</th>
                        <th>Nama Motor</th>
                        <th>Tahun</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pelanggan as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->kode }}</td>
                        <td>{{ $p->noplat }}</td>
                        <td>{{ $p->namamotor }}</td>
                        <td>{{ $p->tahun }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>{{ $p->nohp }}</td>

                        <td>
                            <a href="{{ url('pelanggan/edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ url('pelanggan/destroy', $p->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">
                                    Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
