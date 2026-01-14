@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4">Edit Pelanggan</h2>

    <div class="card shadow-sm mt-3">
        <div class="card-body">

            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Kode</label>
                        <input type="text" name="kode" value="{{ $pelanggan->kode }}" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>No Plat</label>
                        <input type="text" name="noplat" value="{{ $pelanggan->noplat }}" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Nama Motor</label>
                        <input type="text" name="namamotor" value="{{ $pelanggan->namamotor }}" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Tahun</label>
                        <input type="number" name="tahun" value="{{ $pelanggan->tahun }}" class="form-control" required>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control">{{ $pelanggan->alamat }}</textarea>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>No HP</label>
                        <input type="text" name="nohp" value="{{ $pelanggan->nohp }}" class="form-control" required>
                    </div>
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>
</div>
@endsection
