@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>📊 Rekap Laporan Penjualan</h4>

    <a href="{{ route('laporan.penjualan.print', request()->query()) }}"
   target="_blank"
   class="btn btn-success">
    🖨 Print
</a>

</div>
<form method="GET" action="{{ route('laporan.penjualan') }}" class="row g-2 mb-3">
    <div class="col-md-3">
        <label class="form-label">Tanggal Awal</label>
        <input type="date"
               name="tgl_awal"
               value="{{ request('tgl_awal') }}"
               class="form-control">
    </div>

    <div class="col-md-3">
        <label class="form-label">Tanggal Akhir</label>
        <input type="date"
               name="tgl_akhir"
               value="{{ request('tgl_akhir') }}"
               class="form-control">
    </div>

    <div class="col-md-3 align-self-end">
        <button class="btn btn-success">
            🔍 Filter
        </button>

        <a href="{{ route('laporan.penjualan') }}"
           class="btn btn-secondary">
            🔄 Reset
        </a>
    </div>
</form>

<h5 class="mb-4">
    Total Pendapatan:
    <span class="text-white fw-bold">
        Rp {{ number_format($totalPendapatan,0,',','.') }}
    </span>
</h5>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th width="40">No</th>
            <th>No Bukti</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Jumlah Item</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>

    @foreach ($penjualan as $no => $p)
        @php
            $jumlahItem = $p->detail->sum('qty');
            $total = $p->detail->sum('subtotal');
        @endphp

        {{-- ===== MASTER ===== --}}
        <tr class="fw-semibold">
            <td>{{ $no + 1 }}</td>
            <td>{{ $p->nota }}</td>
            <td>{{ $p->pelanggan->nama ?? '-' }}</td>
            <td>{{ $p->tanggal }}</td>
            <td>{{ $p->keterangan ?? '-' }}</td>
            <td>{{ $jumlahItem }}</td>
            <td>Rp {{ number_format($total,0,',','.') }}</td>
        </tr>

        {{-- ===== DETAIL ===== --}}
        <tr>
            <td></td>
            <td colspan="6">
                <table class="table table-sm table-bordered mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($p->detail as $d)
                        <tr>
                            <td>{{ $d->part->kode ?? '-' }}</td>
                            <td>{{ $d->part->nama ?? '-' }}</td>
                            <td>{{ $d->part->jenis->nama ?? '-' }}</td>
                            <td>{{ $d->qty }}</td>
                            <td>{{ number_format($d->harga,0,',','.') }}</td>
                            <td>{{ number_format($d->subtotal,0,',','.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>

    @endforeach

    </tbody>
</table>

@endsection
