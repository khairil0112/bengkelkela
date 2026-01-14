@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    <h2 class="mt-4">Detail Transaksi</h2>

    <a href="{{ url('penjualan') }}" class="btn btn-secondary mb-3">
        &larr; Kembali
    </a>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <strong>Data Transaksi</strong>
        </div>
        <div class="card-body">

            <table class="table table-borderless">
                <tr>
                    <th width="200">No Nota</th>
                    <td>: {{ $transaksi->nota }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>: {{ $transaksi->tanggal }}</td>
                </tr>
                <tr>
                    <th>Pelanggan</th>
                    <td>: {{ $transaksi->pelanggan->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Mekanik</th>
                    <td>: {{ $transaksi->mekanik->namamk ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Kendaraan</th>
                    <td>: {{ $transaksi->kendaraan }}</td>
                </tr>
            </table>

        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Detail Part / Jasa</strong>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Part / Jasa</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @php $grandtotal = 0; @endphp

                    @foreach ($transaksi->detail as $d)
                    @php 
                        $grandtotal += $d->subtotal;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->part->nama ?? 'Tidak ditemukan' }}</td>
                        <td>{{ $d->qty }}</td>
                        <td>Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot class="table-secondary">
                    <tr>
                        <th colspan="4" class="text-end">Grand Total :</th>
                        <th>Rp {{ number_format($grandtotal, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>

</div>
@endsection
