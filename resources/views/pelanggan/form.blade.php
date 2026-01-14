@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">{{ $judul }}</h3>

    <form action="{{ isset($part) ? route('part.update', $part->id) : route('part.store') }}" method="POST">
        @csrf
        @if(isset($part))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="kode" class="form-label">Kode</label>
                    <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode', $part->kode ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Part / Jasa</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $part->nama ?? '') }}" required>
                </div>

                {{-- ✅ Dropdown Kategori --}}
                <div class="mb-3">
                    <label for="idkategori" class="form-label">Kategori</label>
                    <select name="idkategori" id="idkategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->idkategori }}"
                                {{ old('idkategori', $part->idkategori ?? '') == $k->idkategori ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Dropdown Jenis --}}
                <div class="mb-3">
                    <label for="idjenis" class="form-label">Jenis</label>
                    <select name="idjenis" id="idjenis" class="form-control" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($jenis as $j)
                            <option value="{{ $j->idjenis }}"
                                {{ old('idjenis', $part->idjenis ?? '') == $j->idjenis ? 'selected' : '' }}>
                                {{ $j->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                {{-- Dropdown Satuan --}}
                <div class="mb-3">
                    <label for="idsatuan" class="form-label">Satuan</label>
                    <select name="idsatuan" id="idsatuan" class="form-control" required>
                        <option value="">-- Pilih Satuan --</option>
                        @foreach($satuan as $s)
                            <option value="{{ $s->idsatuan }}"
                                {{ old('idsatuan', $part->idsatuan ?? '') == $s->idsatuan ? 'selected' : '' }}>
                                {{ $s->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="stokawal" class="form-label">Stok Awal</label>
                    <input type="number" name="stokawal" id="stokawal" class="form-control" min="0" value="{{ old('stokawal', $part->stokawal ?? 0) }}" required>
                </div>

                <div class="mb-3">
                    <label for="hargaawal" class="form-label">Harga Awal</label>
                    <input type="number" name="hargaawal" id="hargaawal" class="form-control" min="0" value="{{ old('hargaawal', $part->hargaawal ?? 0) }}" required>
                </div>
            </div>
        </div>

        <div class="text-end">
            <a href="{{ route('part.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">{{ isset($part) ? 'Perbarui' : 'Simpan' }}</button>
        </div>
    </form>
</div>
@endsection
