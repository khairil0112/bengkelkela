@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3 class="fw-bold text-white mb-4">Daftar Pelanggan</h3>

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        + Tambah Pelanggan
    </button>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>No Plat</th>
                    <th>Nama Motor</th>
                    <th>Tahun</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th width="120px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->kode }}</td>
                    <td>{{ $p->noplat }}</td>
                    <td>{{ $p->namamotor }}</td>
                    <td>{{ $p->tahun }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->nohp }}</td>
                    <td>
                        <a href="{{ url('/pelanggan/edit/'.$p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ url('/pelanggan/delete/'.$p->id) }}" class="btn btn-danger btn-sm"
                           onclick="return confirm('Hapus pelanggan ini?')">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection
