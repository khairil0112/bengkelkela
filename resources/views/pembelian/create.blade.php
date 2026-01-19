@extends('layouts.app')

@section('content')
    <form action="{{ route('pembelian.index') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-secondary mb-3">← Kembali</button>
    </form>

    <h3><b>Form Tambah Pembelian</b></h3>

    <form action="{{ route('pembelian.store') }}" method="POST">
        @csrf

        {{-- ================= DATA PEMBELIAN ================= --}}
        <div class="bg-primary mt-3 rounded p-2 text-white">Data Pembelian</div>

        <div class="row mt-3">
            <div class="col-md-6 mb-3">
                <label>No. Bukti</label>
                <input type="text" class="form-control" name="kode_pembelian" value="PB-{{ date('YmdHis') }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label>Tanggal</label>
                <input type="date" class="form-control" name="tanggal_pembelian" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Pemasok</label>
                <select name="idpemasok" class="form-select" required>
                    <option value="">-- Pilih Pemasok --</option>
                    @foreach ($pemasok as $p)
                        <option value="{{ $p->idpemasok }}">
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Keterangan</label>
                <input type="text" name="keterangan" class="form-control">
            </div>
        </div>

        {{-- ================= DETAIL PEMBELIAN ================= --}}
        <div class="bg-success mt-4 rounded p-2 text-white">Detail Pembelian</div>

        <table class="table-bordered mt-3 table" id="tabelDetail">
            <thead class="table-light">
                <tr>
                    <th>Part</th>
                    <th width="80">Qty</th>
                    <th width="120">Harga Beli</th>
                    <th width="120">Subtotal</th>
                    <th width="50">#</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="part_id[]" class="form-select partSelect select2" required>
                            <option value="">-- pilih part --</option>
                            @foreach ($part as $p)
                                <option value="{{ $p->id }}" data-harga="{{ $p->hbterakhir }}">
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>

                    </td>
                    <td>
                        <input type="number" name="qty[]" class="form-control qty" value="1" min="1">
                    </td>
                    <td>
                        <input type="number" name="harga[]" class="form-control harga" value="0" readonly>

                    </td>

                    <td>
                        <input type="number" class="form-control subtotal" value="0" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm hapus">X</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-success mb-2" id="tambahBaris">
            + Tambah Baris
        </button>

        <h4 class="mt-3 text-end">
            Total Pembelian: Rp <b id="grandTotal">0</b>
        </h4>

        <input type="hidden" name="grand_total" id="grand_total">

        <button type="submit" class="btn btn-primary mt-3">
            Simpan Pembelian
        </button>
    </form>

    {{-- ================= SCRIPT ================= --}}
    <script>
        $(function() {

            function hitungTotal() {
                let total = 0;

                $('#tabelDetail tbody tr').each(function() {
                    let qty = parseFloat($(this).find('.qty').val()) || 0;
                    let harga = parseFloat($(this).find('.harga').val()) || 0;

                    let subtotal = qty * harga;
                    $(this).find('.subtotal').val(subtotal);

                    total += subtotal;
                });

                $('#grandTotal').text(total.toLocaleString('id-ID'));
                $('#grand_total').val(total);
            }

            // INIT SELECT2
            $('.select2').select2({
                width: '100%'
            });

            // PART DIPILIH → HARGA OTOMATIS (hgterakhir)
            $(document).on('change', '.partSelect', function() {
                let row = $(this).closest('tr');

                let harga = $(this).find('option:selected').data('harga'); // ← dari hgterakhir

                row.find('.harga').val(harga ? harga : 0);
                hitungTotal();
            });

            // QTY BERUBAH
            $(document).on('input', '.qty', function() {
                hitungTotal();
            });

            // TAMBAH BARIS
            $('#tambahBaris').on('click', function() {
                let row = $('#tabelDetail tbody tr:first').clone();

                row.find('.partSelect').val('').trigger('change');
                row.find('.qty').val(1);
                row.find('.harga').val(0);
                row.find('.subtotal').val(0);

                $('#tabelDetail tbody').append(row);

                // re-init select2
                row.find('.select2').select2({
                    width: '100%'
                });
            });

            // HAPUS BARIS
            $(document).on('click', '.hapus', function() {
                $(this).closest('tr').remove();
                hitungTotal();
            });

        });
    </script>
@endsection
