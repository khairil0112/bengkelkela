@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4">Edit Pemasok</h2>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <form action="{{ route('pemasok.update', $pemasok->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Kode</label>
                        <input type="text" name="kode" value="{{ $pemasok->kode }}" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" value="{{ $pemasok->nama }}" class="form-control" required>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control">{{ $pemasok->alamat }}</textarea>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>No HP</label>
                        <input type="text" name="nohp" value="{{ $pemasok->nohp }}" class="form-control">
                    </div>
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('pemasok.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
