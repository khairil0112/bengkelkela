@extends('layouts.app')

@section('content')

<a href="{{ url('penjualan/index') }}" class="btn btn-secondary mb-3">← Kembali</a>

<h3><b>Edit Penjualan</b></h3>

<form action="{{ url('penjualan/update', $penjualan->id) }}" method="POST">
    @csrf
    <!-- ===================== DATA PENJUALAN ===================== -->
    <div class="bg-primary text-white p-2 rounded mt-3">Data Penjualan</div>

    <div class="row mt-3">
        <div class="col-md-6 mb-3">
            <label>No. Nota</label>
            <input type="text" value="{{ $penjualan->nota }}" class="form-control" name="nota" readonly>
        </div>

        <div class="col-md-6 mb-3">
            <label>Tanggal</label>
            <input type="date" class="form-control" name="tanggal" value="{{ $penjualan->tanggal }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Mekanik</label>
            <select name="mekanik_id" id="selectMekanik" class="form-select" required>
                <option value="">-- Pilih mekanik --</option>
                @foreach ($mekanik as $s)
                    <option value="{{ $s->id }}" {{ $penjualan->mekanik_id == $s->id ? 'selected' : '' }}>
                        {{ $s->namamk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>Pelanggan</label>
            <select name="pelanggan_id" id="selectPelanggan" class="form-select" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($pelanggan as $s)
                <option value="{{ $s->id }}" 
                    data-namamotor="{{ $s->namamotor }}"
                    data-nopol="{{ $s->nopol }}"
                    {{ $penjualan->pelanggan_id == $s->id ? 'selected' : '' }}>
                    {{ $s->nama }}
                </option>
                @endforeach
            </select>
        </div>

        @php
            [$namaMotor, $noPol] = explode(" - ", $penjualan->kendaraan);
        @endphp

        <div class="col-md-6 mb-3">
            <label>Nama Kendaraan</label>
            <input type="text" class="form-control" name="namamotor" id="namamotor" value="{{ $namaMotor }}" readonly>
        </div>

        <div class="col-md-6 mb-3">
            <label>No. Polisi</label>
            <input type="text" class="form-control" name="nopol" id="nopol" value="{{ $noPol }}" readonly>
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

        @foreach($penjualan->detail as $d)
        <tr>
            <td>
                <select name="part[]" class="form-select partSelect" required>
                    <option value="">-- pilih part --</option>
                    @foreach($part as $p)
                        <option value="{{ $p->id }}" data-harga="{{ $p->hargaawal }}"
                            {{ $d->partjasa_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="qty[]" class="form-control qty" value="{{ $d->qty }}" min="1" required></td>
            <td><input type="number" class="form-control harga" value="{{ $d->harga }}" readonly></td>
            <td><input type="number" class="form-control subtotal" value="{{ $d->subtotal }}" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm hapus">X</button></td>
        </tr>
        @endforeach

        </tbody>
    </table>

    <button type="button" class="btn btn-success mb-2" id="tambahBaris">+ Tambah Baris</button>

    <h4 class="text-end mt-3">Total Akhir: <b id="grandTotal">0</b></h4>

    <button type="submit" class="btn btn-primary mt-3">Update Penjualan</button>
</form>


<script>
document.addEventListener("DOMContentLoaded", function () {

    /* SELECT2 */
    $('#selectMekanik').select2({ width: "100%" });
    $('#selectPelanggan').select2({ width: "100%" });

    $(".partSelect").select2({ width: "100%" });

    // Ketika pelanggan berubah
    $('#selectPelanggan').on("change", function(){
        let opt = this.selectedOptions[0];
        namamotor.value = opt.dataset.namamotor;
        nopol.value = opt.dataset.nopol;
    });

    function hitung() {
        let total = 0;
        document.querySelectorAll("#tabelDetail tbody tr").forEach(function(row){
            let qty = parseFloat(row.querySelector(".qty").value) || 0;
            let harga = parseFloat(row.querySelector(".harga").value) || 0;
            let sub = qty * harga;

            row.querySelector(".subtotal").value = sub;
            total += sub;
        });
        document.getElementById("grandTotal").textContent = total.toLocaleString();
    }

    $(document).on("change", ".partSelect", function(){
        let harga = $(this).find(":selected").data("harga") || 0;
        this.closest("tr").querySelector(".harga").value = harga;
        hitung();
    });

    $(document).on("input", ".qty", hitung);

    $(document).on("click", ".hapus", function(){
        $(this).closest("tr").remove();
        hitung();
    });

    // Tambah baris
    document.getElementById("tambahBaris").addEventListener("click", function(){
        let baris = `
        <tr>
            <td>
                <select name="part[]" class="form-select partSelect" required>
                    <option value="">-- pilih part --</option>
                    @foreach($part as $p)
                        <option value="{{ $p->id }}" data-harga="{{ $p->hargaawal }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="qty[]" class="form-control qty" value="1" min="1"></td>
            <td><input type="number" class="form-control harga" value="0" readonly></td>
            <td><input type="number" class="form-control subtotal" value="0" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm hapus">X</button></td>
        </tr>
        `;

        document.querySelector("#tabelDetail tbody").insertAdjacentHTML("beforeend", baris);

        $(".partSelect").select2({ width: "100%" });
    });

    hitung(); // Hitung awal
});
</script>

@endsection
