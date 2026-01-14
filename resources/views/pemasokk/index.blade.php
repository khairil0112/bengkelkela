@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
<h2 class="mt-4">Data Pemasok</h2>
    <div class="d-flex justify-content-between align-items-center mb-3">        
        <a href="{{ url('pemasok/create') }}" class="btn btn-primary">+ Tambah Pemasok</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
        <div class="card-body p-0">
            <table class="table table-bordered m-0">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Pemasok</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemasok as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>{{ $p->hp }}</td>
                        <td>
                            <a href="{{ url('pemasok/edit', $p->idpemasok) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <form action="{{ url('pemasok/destroy', $p->idpemasok) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if($pemasok->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada data pemasok</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
