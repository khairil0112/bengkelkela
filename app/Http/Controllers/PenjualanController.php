<?php

namespace App\Http\Controllers;

use App\Models\Detail_transaksi;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Mekanik;
use App\Models\Partdanjasa;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    // helper generate nota
    private function generateNota($id)
    {
        $kode = "KAA";
        $idStr = str_pad($id, 3, '0', STR_PAD_LEFT);
        $tgl = date("dmY");
        $jam = date("His");

        return $kode . $idStr . $tgl . $jam;
    }

    public function index()
    {
        $transaksi = Penjualan::with(['pelanggan','mekanik'])->get();
        return view('penjualan.index', compact('transaksi'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $mekanik = Mekanik::all();
        $part = Partdanjasa::all();

        $nextId = (int) (Penjualan::max('id') ?? 0) + 1;
        $notaPreview = $this->generateNota($nextId);

        return view('penjualan.create', compact('pelanggan','mekanik','part','notaPreview'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nota'          => 'required|string',
            'tanggal'       => 'required|date',
            'pelanggan_id'  => 'required',
            'mekanik_id'    => 'required',
            'namamotor'     => 'required',
            'nopol'         => 'required',
            'part.*'        => 'required',
            'qty.*'         => 'required|numeric|min:1',
        ]);

        // SIMPAN MASTER
        $penjualan = Penjualan::create([
            'nota'         => $request->nota,
            'tanggal'      => $request->tanggal,
            'pelanggan_id' => $request->pelanggan_id,
            'mekanik_id'   => $request->mekanik_id,
            'keterangan'   => $request->keterangan,
            'kendaraan'    => $request->namamotor . ' - ' . $request->nopol,
        ]);

        // SIMPAN DETAIL
        for ($i = 0; $i < count($request->part); $i++) {
            $partModel = Partdanjasa::find($request->part[$i]);
            $harga = $partModel ? $partModel->hargaawal : 0;
            $qty = $request->qty[$i];
            $sub = $harga * $qty;

            Detail_transaksi::create([
                'transaksi_id' => $penjualan->id,
                'partjasa_id'  => $request->part[$i],
                'qty'          => $qty,
                'harga'        => $harga,
                'subtotal'     => $sub,
            ]);
        }

        return redirect()->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil ditambahkan!');
    }

    public function detail($id)
    {
        $transaksi = Penjualan::with(['pelanggan','mekanik','detail.part'])
            ->findOrFail($id);

        return view('penjualan.detail', compact('transaksi'));
    }

    public function edit($id)
    {
        $penjualan  = Penjualan::with(['detail.part'])->findOrFail($id);
        $pelanggan  = Pelanggan::all();
        $mekanik    = Mekanik::all();
        $part       = Partdanjasa::all();

        return view('penjualan.edit', compact('penjualan','pelanggan','mekanik','part'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nota'         => 'required',
            'tanggal'      => 'required|date',
            'pelanggan_id' => 'required',
            'mekanik_id'   => 'required',
            'namamotor'    => 'required',
            'nopol'        => 'required',
            'part.*'       => 'required',
            'qty.*'        => 'required|numeric|min:1',
        ]);

        // UPDATE MASTER
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update([
            'tanggal'      => $request->tanggal,
            'pelanggan_id' => $request->pelanggan_id,
            'mekanik_id'   => $request->mekanik_id,
            'keterangan'   => $request->keterangan,
            'kendaraan'    => $request->namamotor . ' - ' . $request->nopol,
        ]);

        Detail_transaksi::where('transaksi_id', $id)->delete();

        // DETAIL BARU
        for ($i = 0; $i < count($request->part); $i++) {
            $part       = Partdanjasa::find($request->part[$i]);
            $harga      = $part ? $part->hargaawal : 0;
            $qty        = $request->qty[$i];
            $subtotal   = $harga * $qty;

            Detail_transaksi::create([
                'transaksi_id' => $id,
                'partjasa_id'  => $request->part[$i],
                'qty'          => $qty,
                'harga'        => $harga,
                'subtotal'     => $subtotal,
            ]);
        }

        return redirect()->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Penjualan::findOrFail($id)->delete();

        return redirect()->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil dihapus');
    }

    // ============================================================
    //                  🔥 FUNGSI CETAK NOTA BARU
    // ============================================================
    public function cetak($id)
    {
        $transaksi = Penjualan::with(['pelanggan','mekanik','detail.part'])
            ->findOrFail($id);

        return view('penjualan.nota', compact('transaksi'));
    }
}
