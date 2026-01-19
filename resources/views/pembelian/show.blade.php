@extends('layouts.app')

@section('title', 'Detail Pembelian')

@section('content')
    <div class="container-fluid px-4">

        <h2 class="mt-4">Detail Pembelian</h2>

        <form action="{{ route('pembelian.index') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-secondary mb-3">← Kembali</button>
        </form>

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark text-white">
                <strong>Data Pembelian</strong>
            </div>
            <div class="card-body">

                <table class="table-borderless table">
                    <tr>
                        <th width="200">Nomor Bukti</th>
                        <td>: {{ $pembelian->kode_pembelian }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>: {{ $pembelian->tanggal_pembelian }}</td>
                    </tr>
                    <tr>
                        <th>Pemasok</th>
                        <td>: {{ $pembelian->pemasok->nama_pemasok ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>: {{ $pembelian->keterangan ?? '-' }}</td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <strong>Detail Part / Jasa</strong>
            </div>

            <div class="card-body">
                <table class="table-bordered table-striped table">
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

                        @foreach ($pembelian->details as $d)
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
                            <th>Rp {{ number_format($pembelian->grand_total, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>

    </div>
@endsection
