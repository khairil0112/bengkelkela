@extends('layouts.app')

@section('content')


<a href="{{ url('penjualan/index') }}" class="btn btn-secondary mb-3">← Kembali</a>

<h3><b>Form Tambah Penjualan (Master - Detail)</b></h3>

<form action="{{ url('penjualan/store') }}" method="POST">
    @csrf

    <!-- ===================== DATA PENJUALAN ===================== -->
    <div class="bg-primary text-white p-2 rounded mt-3">Data Penjualan</div>

    <div class="row mt-3">
        <div class="col-md-6 mb-3">
            <label>No. Nota</label>
            <!-- Nota dari controller -->
            <input type="text" value="{{ $notaPreview ?? '' }}" class="form-control" name="nota" required readonly>
        </div>

        <div class="col-md-6 mb-3">
            <label>Tanggal</label>
            <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required>
        </div>

       <div class="col-md-6 mb-3">
              <label class="form-label">Mekanik</label>
              <select name="mekanik_id" id="selectMekanik" class="form-select" required>
                <option value="">-- Pilih mekanik --</option>
                @foreach ($mekanik as $s)
                  <option value="{{ $s->id }}">{{ $s->namamk }}</option>
                @endforeach
              </select>
        </div>
    
        <div class="col-md-6 mb-3">
              <label class="form-label">Pelanggan</label>
              <select name="pelanggan_id" id="idpelanggan" class="form-control selectPelanggan" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($pelanggan as $s)
                <option value="{{ $s->id }}"
                    data-namamotor="{{ $s->namamotor ?? '' }}"
                    data-nopol="{{ $s->nopol ?? '' }}">
                    {{ $s->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>Nama Kendaraan</label> 
            <input type="text" class="form-control" name="namamotor" id="namamotor" readonly>
        </div>

        <div class="col-md-6 mb-3">
            <label>No. Polisi</label>
            <input type="text" class="form-control" name="nopol" id="nopol" readonly>
        </div>

        <div class="col-md-6 mb-3">
                <label>Keterangan</label>
                <input type="text" name="keterangan" class="form-control">
            </div>
    </div>

    <!-- ===================== DETAIL ===================== -->
    <div class="bg-success text-white p-2 rounded mt-4">Detail Barang / Jasa</div>

    <table class="table table-bordered mt-3" id="tabelDetail">
        <thead class="table-light">
            <tr>
                <th>Barang/Jasa</th>
                <th width="80px">Qty</th>
                <th width="120px">Harga Satuan</th>
                <th width="120px">Subtotal</th>
                <th width="50px">#</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select name="part[]" class="form-select partSelect" required>
                        <option value="">-- pilih part --</option>
                        @foreach($part as $p)
                            <option value="{{ $p->id }}" data-harga="{{ $p->hargaawal }}">
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="qty[]" class="form-control qty" value="1" min="1" required></td>
                <td><input type="number" class="form-control harga" value="0" readonly></td>
                <td><input type="number" class="form-control subtotal" value="0" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm hapus">X</button></td>
            </tr>
        </tbody>
    </table>

    <button type="button" class="btn btn-success mb-2" id="tambahBaris">+ Tambah Baris</button>

    <h4 class="text-end mt-3">Total Akhir: <b id="grandTotal">0</b></h4>

    <button type="submit" class="btn btn-primary mt-3">Simpan Penjualan</button>
</form>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ======================================================
       FIX 1 — Gunakan EVENT SELECT2 agar terbaca
    ====================================================== */
    $('#idpelanggan').on('change.select2', function(){
        let opt = this.selectedOptions[0];

        document.getElementById("namamotor").value = opt.dataset.namamotor || "";
        document.getElementById("nopol").value = opt.dataset.nopol || "";
    });


    /* ======================================================
       Hitung subtotal & grand total
    ====================================================== */
    function hitung() {
        let grand = 0;

        document.querySelectorAll("#tabelDetail tbody tr").forEach(function(row) {
            let qty = parseFloat(row.querySelector(".qty").value) || 0;
            let harga = parseFloat(row.querySelector(".harga").value) || 0;
            let sub = qty * harga;

            row.querySelector(".subtotal").value = sub;
            grand += sub;
        });

        document.getElementById("grandTotal").textContent = grand.toLocaleString();
    }


    /* ======================================================
       Part berubah → ambil harga
    ====================================================== */
    $(document).on("change", ".partSelect", function () {
        let harga = $(this).find(":selected").data("harga") || 0;
        let row = this.closest("tr");

        row.querySelector(".harga").value = harga;
        hitung();
    });


    /* ======================================================
       Qty berubah
    ====================================================== */
    $(document).on("input", ".qty", function () {
        hitung();
    });


    /* ======================================================
       Hapus baris
    ====================================================== */
    $(document).on("click", ".hapus", function () {
        $(this).closest("tr").remove();
        hitung();
    });


    /* ======================================================
       Tambah baris
    ====================================================== */
    document.getElementById("tambahBaris").addEventListener("click", function () {

        let tbody = document.querySelector("#tabelDetail tbody");

        let row = `
        <tr>
            <td>
                <select name="part[]" class="form-select partSelect" required>
                    <option value="">-- pilih part --</option>
                    @foreach($part as $p)
                        <option value="{{ $p->id }}" data-harga="{{ $p->hargaawal }}">
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="qty[]" class="form-control qty" value="1"></td>
            <td><input type="number" class="form-control harga" value="0" readonly></td>
            <td><input type="number" class="form-control subtotal" value="0" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm hapus">X</button></td>
        </tr>`;

        tbody.insertAdjacentHTML("beforeend", row);

        aktifkanSelect2();
    });


    /* ======================================================
       ACTIVE SELECT2 TANPA ERROR DOUBLE
    ====================================================== */
    function aktifkanSelect2() {

        $(".partSelect").select2({
            dropdownParent: $("#tabelDetail"),   // FIX DUPLIKAT SELECT
            width: "100%",
        });

        $("#idpelanggan").select2({
            width: "100%",
        });

        $("#selectMekanik").select2({
            width: "100%",
        });
    }

    aktifkanSelect2();

});
</script>

@endsection
