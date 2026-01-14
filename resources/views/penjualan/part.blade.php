@extends('layout.template')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">Data Sparepart</h3>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM TAMBAH --}}
    <div class="card p-3 mb-4">
        <h5>Tambah Sparepart</h5>

        <form action="{{ route('part.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Kode Part</label>
                    <input type="text" name="kode" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label>Nama Part</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" min="0" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    {{-- TABLE LIST --}}
    <div class="card p-3">
        <h5>Daftar Sparepart</h5>

        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th width="120px">Kode</th>
                    <th>Nama</th>
                    <th width="150px">Harga (Rp)</th>
                    <th width="120px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($part as $p)
                <tr>
                    <td>{{ $p->kode }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('part.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('part.destroy', $p->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
