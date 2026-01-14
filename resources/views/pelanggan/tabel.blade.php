@extends('layouts.app')

@section('content')
    <div class="header">
        <h3 class="mb-3">{{ $judul }}</h3>
    </div>
    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

   <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan">
    + Tambah Part
  </button>


    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th width="5%">No</th>
                <!-- <th>ID</th> -->
                <th>Kode</th>
                <th>Nama Pelanggan</th>
                <th>No Plat</th>
                <th>Nama Motor</th>
                <th>Tahun</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            
            @forelse ($data as $index => $item)
            <tr>
                <td class="text-center">{{ $data->firstItem() + $index }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nopol }}</td>
                <td>{{ $item->namamotor }}</td>
                <td>{{ $item->tahun }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->hp }}</td>                     
                    
                <td class="text-center">
                    <!-- Tombol Edit (POST) -->
                    <!-- <form action="{{ route('pelanggan.edit', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                    </form> -->
                    <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    
                    <!-- Tombol Hapus (POST) -->
                    <form action="{{ url('pelanggan/destroy', $item->id) }}" method="POST" class="d-inline" 
                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">Tidak ada data Pelanggan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    
@endsection
@include('pelanggan.modal_tambah')
