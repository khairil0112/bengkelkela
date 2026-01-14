<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pembelian;
use App\Models\Detail_transaksi;
use App\Models\Pemasok;
use App\Models\Partdanjasa;

class PembelianController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembelian::with('pemasok')->orderBy('id_pembelian', 'desc');

        // dd($query);
        if ($request->filled('from')) {
            $query->where('tanggal_pembelian', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->where('tanggal_pembelian', '<=', $request->to);
        }

        if ($request->filled('kode')) {
            $query->where('kode_pembelian', 'like', '%' . $request->kode . '%');
        }

        if ($request->filled('pemasok')) {
            $query->whereHas('pemasok', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->pemasok . '%');
            });
        }

        $pembelian = $query->get();
        dd($pembelian);
        return view('pembelian.index', compact('pembelian'));
    }

    public function create()
    {
        $pemasok = Pemasok::all();
        $part = Partdanjasa::all();
        return view('pembelian.create', compact('pemasok', 'part'));
    }

    public function store(Request $request)
    {

        // dd($request);
        // ================= VALIDASI =================
        $request->validate([
            'kode_pembelian' => 'required',
            'tanggal_pembelian' => 'required|date',
            'idpemasok' => 'required',
            'part_id' => 'required|array|min:1',
            'part_id.*' => 'required|exists:partdanjasa,id',
            'qty' => 'required|array',
            'qty.*' => 'required|integer|min:1',
        ]);


        // dd($request->part_id);
        // ================= SIMPAN PEMBELIAN (MASTER) =================
        $pembelian = Pembelian::create([
            'kode_pembelian' => $request->kode_pembelian,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'idpemasok' => $request->idpemasok,
            'keterangan' => $request->keterangan,
            'total_harga' => 0,
            'diskon' => 0,
            'pajak' => 0,
            'grand_total' => 0,
        ]);

        $total = 0;

        // ================= SIMPAN DETAIL =================
        foreach ($request->part_id as $index => $partId) {

            $qty = (int) $request->qty[$index];

            $part = Partdanjasa::findOrFail($partId);

            $harga = $part->hbterakhir;
            $subtotal = $qty * $harga;

            Detail_transaksi::create([
                'transaksi_id' => $pembelian->id_pembelian,
                'partjasa_id' => $partId,
                'qty' => $qty,
                'harga' => $harga,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;

            $part->increment('stokawal', $qty);
        }


        // ================= UPDATE TOTAL =================
        $pembelian->update([
            'total_harga' => $total,
            'grand_total' => $total,
        ]);

        DB::commit();

        $query = Pembelian::with('pemasok')->orderBy('id_pembelian', 'desc');

        if ($request->filled('from')) {
            $query->where('tanggal_pembelian', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->where('tanggal_pembelian', '<=', $request->to);
        }

        if ($request->filled('kode')) {
            $query->where('kode_pembelian', 'like', '%' . $request->kode . '%');
        }

        if ($request->filled('pemasok')) {
            $query->whereHas('pemasok', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->pemasok . '%');
            });
        }

        $pembelian = $query->get();
        return view('pembelian.index', compact('pembelian'));

        // DB::beginTransaction();

        // try {

        // } catch (\Exception $e) {
        //     DB::rollBack();

        //     return back()->withErrors($e->getMessage());
        // }
    }

    public function show($id)
    {
        $pembelian = Pembelian::with('details.part')
            ->where('id_pembelian', $id)
            ->firstOrFail();

        return view('pembelian.show', compact('pembelian'));
    }

    public function destroy($id)
    {
        Pembelian::where('id_pembelian', $id)->delete();

        return redirect()->route('pembelian.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
