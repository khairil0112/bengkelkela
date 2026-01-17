@extends('layouts.app')

@section('content')

<h3 class="mb-4"><b>Kartu Stok</b></h3>

@if(!$part)
    <div class="alert alert-danger">
        Data part tidak ditemukan
    </div>
@else

<div class="card">
    <div class="card-header bg-primary text-white">
        <b>{{ $part->kode }} - {{ $part->nama }}</b>
    </div>

    <div class="card-body">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Stok Akhir</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mutasi as $i => $m)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ date('d-m-Y', strtotime($m->created_at)) }}</td>
                    <td>{{ $m->keterangan ?? '-' }}</td>
                    <td>{{ $m->stok_masuk ?? 0 }}</td>
                    <td>{{ $m->stok_keluar ?? 0 }}</td>
                    <td>{{ $m->stok_akhir }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada mutasi stok
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('stok.index') }}" class="btn btn-secondary mt-3">
            ⬅ Kembali
        </a>
    </div>
</div>

@endif
@endsection
