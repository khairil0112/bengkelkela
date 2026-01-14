@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4">Tambah Pemasok</h2>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <form action="{{ url('pemasok/store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Kode</label>
                        <input type="text" name="kode" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control"></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>No HP</label>
                        <input type="text" name="nohp" class="form-control">
                    </div>
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="{{ url('pemasok') }}" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
</div>
@endsection
