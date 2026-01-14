<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // ================================
    // 📊 REKAP PENJUALAN
    // ================================
    public function rekap(Request $request)
    {
        $query = Penjualan::with([
            'pelanggan',
            'detail.part.jenis'
        ])->orderBy('tanggal', 'DESC');

        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tanggal', [
                $request->tgl_awal,
                $request->tgl_akhir
            ]);
        }

        $penjualan = $query->get();

        $totalPendapatan = $penjualan->sum(function ($p) {
            return $p->detail->sum('subtotal');
        });

        return view('laporan.penjualan', compact(
            'penjualan',
            'totalPendapatan'
        ));
    }

    // ================================
    // 🧾 DETAIL REKAP PER TANGGAL
    // ================================
    public function rekapDetail($tanggal)
    {
        $data = Penjualan::with(['pelanggan', 'mekanik'])
            ->where('tanggal', $tanggal)
            ->get()
            ->map(function ($item) {
                $item->total = $item->detail()->sum('subtotal');
                return $item;
            });

        return view('laporan.detail', compact('data', 'tanggal'));
    }
    public function print(Request $request)
    {
        $query = Penjualan::with([
            'pelanggan',
            'detail.part.jenis'
        ])->orderBy('tanggal', 'DESC');

        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tanggal', [
                $request->tgl_awal,
                $request->tgl_akhir
            ]);
        }

        $penjualan = $query->get();

        $totalPendapatan = $penjualan->sum(function ($p) {
            return $p->detail->sum('subtotal');
        });

        return view('laporan.penjualan_print', compact(
            'penjualan',
            'totalPendapatan'
        ));
    }
}
