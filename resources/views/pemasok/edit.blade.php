@extends('layouts.app')

@section('content')
    <div class="header">
        <h3 class="mb-3">Edit Pemasok</h3>
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
        <form action="{{ url('pemasok') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="btn btn-secondary">
                ← Kembali
            </button>
        </form><br>
    <form action="{{ url('pemasok/update', $pemasok->idpemasok) }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $pemasok->id }}">
        <!-- Kode pemasok -->
        <div class="row">
        <div class="col-md-6">
            <label class="form-label">Kode</label>
            <input type="text" name="kode" value="{{ old('kode', $pemasok->kode) }}"
                   class="form-control" readonly>
        </div>

        <!-- Nama pemasok -->
        <div class="col-md-6">
            <label class="form-label">Nama pemasok</label>
            <input type="text" name="nama" value="{{ old('nama', $pemasok->nama) }}"
                   class="form-control">
        </div>                                      

        <!-- Alamat  -->
        <div class="col-md-6">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" value="{{ old('alamat', $pemasok->alamat) }}"
                   class="form-control">
        </div>

        <!-- No hp -->
        <div class="col-md-6">
            <label class="form-label">No Hp</label>
            <input type="number" name="hp" value="{{ old('hp', $pemasok->hp) }}"
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
