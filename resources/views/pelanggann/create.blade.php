@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4">Tambah Pelanggan</h2>

    <div class="card shadow-sm mt-3">
        <div class="card-body">

            <form action="{{ url('pelanggan/store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Kode</label>
                        <input type="text" name="kode" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>No Plat</label>
                        <input type="text" name="noplat" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Nama Motor</label>
                        <input type="text" name="namamotor" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Tahun</label>
                        <input type="number" name="tahun" class="form-control" required>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>No HP</label>
                        <input type="text" name="nohp" class="form-control" required>
                    </div>
                </div>

                <button class="btn btn-success">Simpan</button>
                <a href="{{ url('pelanggan/index') }}" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>
</div>
@endsection
