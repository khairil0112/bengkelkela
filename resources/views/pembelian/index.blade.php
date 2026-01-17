@extends('layouts.app')

@section('title', 'Data Pembelian')

@section('content')
<div class="container-fluid">

    <h3 class="fw-bold mb-4 text-primary">Data Pembelian</h3>

    {{-- ================= FILTER ================= --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('pembelian.index') }}">
                <div class="row g-3 align-items-end">

                    <div class="col-md-3">
                        <label>Dari Tanggal</label>
                        <input type="date" name="from"
                               class="form-control"
                               value="{{ request('from') }}">
                    </div>

                    <div class="col-md-3">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="to"
                               class="form-control"
                               value="{{ request('to') }}">
                    </div>

                    <div class="col-md-3">
                        <label>Nomor Bukti</label>
                        <input type="text"
                               name="kode"
                               class="form-control"
                               placeholder="Cari Nomor Bukti..."
                               value="{{ request('kode') }}">
                    </div>

                    <div class="col-md-3">
                        <label>Nama Pemasok</label>
                        <input type="text"
                               name="pemasok"
                               class="form-control"
                               placeholder="Cari Nama Pemasok..."
                               value="{{ request('pemasok') }}">
                    </div>

                    <div class="col-md-12 mt-2">
                        <button class="btn btn-primary px-4">Filter</button>
                        <a href="{{ route('pembelian.index') }}"
                           class="btn btn-secondary px-4">Reset</a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- ================= TOMBOL TAMBAH ================= --}}
    <div class="mb-3">
        <a href="{{ route('pembelian.create') }}"
           class="btn btn-success px-4">
            + Tambah Pembelian
        </a>
    </div>

    {{-- ================= TABEL ================= --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th width="50">No</th>
                        <th>Nomor Bukti</th>
                        <th>Tanggal</th>
                        <th>Pemasok</th>
                        <th>Keterangan</th>
                        <th>Total</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembelian as $i => $row)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $row->kode_pembelian }}</td>
                        <td>{{ $row->tanggal_pembelian }}</td>
                        <td>{{ $row->pemasok->nama ?? '-' }}</td>
                        <td>{{ $row->keterangan ?? '-' }}</td>
                        <td class="text-end">
                            Rp {{ number_format($row->grand_total, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pembelian.cetak', $row->id_pembelian) }}"
                               class="btn btn-sm btn-info mb-1" target="_blank">
                                Cetak Nota
                            </a>

                            <a href="{{ route('pembelian.show', $row->id_pembelian) }}"
                               class="btn btn-sm btn-primary mb-1">
                                Detail
                            </a>

                            <a href="{{ route('pembelian.edit', $row->id_pembelian) }}"
                               class="btn btn-sm btn-warning mb-1">
                                Edit
                            </a>

                            <form action="{{ route('pembelian.destroy', $row->id_pembelian) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            Data pembelian belum ada
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
