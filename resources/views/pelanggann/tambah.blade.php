@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Tambah Pelanggan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/pelanggan">Pelanggan</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Form Tambah Pelanggan</h5>

            <form action="{{ url('pelanggan/store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kode Pelanggan</label>
                        <input type="text" name="kode" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">No Plat</label>
                        <input type="text" name="noplat" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Motor</label>
                        <input type="text" name="namamotor" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" min="1900" class="form-control" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2" required></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" name="nohp" class="form-control" required>
                    </div>

                </div>

                <button class="btn btn-primary mt-3">💾 Simpan</button>
                <a href="/pelanggan" class="btn btn-secondary mt-3">Kembali</a>

            </form>

        </div>
    </div>
</section>

@endsection
