<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokController extends Controller
{
    // LIST DATA STOK
    public function index()
    {
        $stok = DB::table('partdanjasa')
            ->leftJoin('stok', 'stok.partdanjasa_id', '=', 'partdanjasa.id')
            ->select(
                'partdanjasa.id',
                'partdanjasa.kode',
                'partdanjasa.nama',
                DB::raw('MAX(stok.stok_akhir) as sisa_stok')
            )
            ->groupBy('partdanjasa.id', 'partdanjasa.kode', 'partdanjasa.nama')
            ->orderBy('partdanjasa.nama')
            ->get();

        return view('stok.index', compact('stok'));
    }

    public function kartu(Request $request)
    {
        $request->validate([
            'partdanjasa_id' => 'required|exists:partdanjasa,id'
        ]);
    
        $id = $request->partdanjasa_id;
    
        $part = DB::table('partdanjasa')
            ->where('id', $id)
            ->first();
    
        $mutasi = DB::table('stok')
            ->where('partdanjasa_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();
    
        return view('stok.kartu', compact('part', 'mutasi'));
    }
    
}
