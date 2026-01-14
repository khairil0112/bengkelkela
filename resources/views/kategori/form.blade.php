@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $judul }}</h3>

    <form method="POST" action="{{ $kategori ? route('kategori.update', $kategori->idkategori) : route('kategori.store') }}">
        @csrf
        @if($kategori)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Kode</label>
            <input type="text" name="kode" class="form-control" value="{{ old('kode', $kategori->kode ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $kategori->nama ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $kategori->keterangan ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
