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

   <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPart">
    + Tambah Part
  </button>


    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr class="text-center">
                <th width="5%">No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th> 
                <th>Satuan</th>
                <th>Jenis</th>
                <th>No Seri</th>
                <th>Stok Awal</th>             
                <th>Harga Awal</th>
                <th>Harga Rata</th>
                <th>Harga Terakhir</th>
                <th width="12%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            
            @forelse ($data as $index => $item)
            <tr>
                <td class="text-center">{{ $data->firstItem() + $index }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->namakategori }}</td>
                <td>{{ $item->namasatuan }}</td>
                <td>{{ $item->namajenis }}</td>
                <td>{{ $item->noseri }}</td>
                <td>{{ $item->stokawal }}</td>
                
                <td>Rp. {{ number_format($item->hargaawal, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($item->hargarata, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($item->hbterakhir, 0, ',', '.') }}</td>
                    
                <td class="text-center">
                    <!-- Tombol Edit (POST) -->
                    <a href="{{ url('part/edit/' . $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <!-- Tombol Hapus (POST) -->
                    <form action="{{ url('part/delete', $item->id) }}" method="POST" class="d-inline" 
                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">Tidak ada data part/jasa</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $data->links() }}
    </div>

@endsection
@include('partdanjasa.modal_tambah')
