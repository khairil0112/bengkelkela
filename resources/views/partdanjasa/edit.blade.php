@extends('layouts.app')

@section('content')
    <div class="header">
        <h3 class="mb-3">{{ $judul }}</h3>
    </div>

    <!-- Pesan sukses -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Validasi error -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Terjadi kesalahan!</strong>
            <ul class="list-disc ml-5 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-edit mt-8">
        <form action="{{ url('part') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="btn btn-secondary">
                ← Kembali
            </button>
        </form><br>
    <form action="{{ url('part/update', $part->id) }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $part->id }}">
        <!-- Kode Part -->
        <div class="row">
        <div class="col-md-6">
            <label class="form-label">Kode Part</label>
            <input type="text" name="kode" value="{{ old('kode', $part->kode) }}"
                   class="form-control" readonly>
        </div>

        <!-- Nama Part -->
        <div class="col-md-6">
            <label class="form-label">Nama Part</label>
            <input type="text" name="nama" value="{{ old('nama', $part->nama) }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mb-3">
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


        <!-- Jenis -->
        <div class="col-md-6 mb-3">
              <label class="form-label">Jenis</label>
              <select name="idjenis" class="form-select" required>
                <option value="">-- Pilih Jenis --</option>
                @foreach ($jenis as $j)
                  <option value="{{ $j->idjenis }}"{{ $j->idjenis == $part->idjenis ? 'selected' : '' }}> 
                  {{ $j->nama }}
                  </option>
                @endforeach
              </select>
            </div>  

        <!-- Satuan -->
        <div class="col-md-6 mb-3" >
            <label class="form-label">Satuan</label>
            <select name="idsatuan" class="form-select">
                <option value="">-- Pilih Satuan --</option>
                @foreach ($satuan as $s)
                    <option value="{{ $s->idsatuan }}" {{ $s->idsatuan == $part->idsatuan ? 'selected' : '' }}>
                        {{ $s->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- No Seri -->
        <div class="col-md-6">
            <label class="form-label">No Seri</label>
            <input type="text" name="noseri" value="{{ old('noseri', $part->noseri) }}"
                   class="form-control">
        </div>

        <!-- Stok -->
        <div class="col-md-6">
            <label class="form-label">Stok awal</label>
            <input type="number" name="stokawal" value="{{ old('stokawal', $part->stokawal) }}"
                   class="form-control">
        </div>        
               
        <!-- Harga awal -->
        <div class="col-md-6">
            <label class="form-label">Harga awal</label>
            <input type="number" step="0.01" name="hargaawal" value="{{ old('hargaawal', $part->hargaawal) }}"
                   class="form-control">
        </div>

        <!-- Harga rata rata -->
        <div class="col-md-6">
            <label class="form-label">Harga rata-rata</label>
            <input type="number" step="0.01" name="hargarata" value="{{ old('hargarata', $part->hargarata) }}"
                   class="form-control">
        </div>

        <!-- Harga beli terakhir -->
        <div class="col-md-6">
            <label class="form-label">Harga Beli Terakhir</label>
            <input type="number" step="0.01" name="hbterakhir" value="{{ old('hbterakhir', $part->hbterakhir) }}"
                   class="form-control">
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-between items-center mt-6">
            <button type="submit" class="btn btn-success">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
    
</div>
@endsection
