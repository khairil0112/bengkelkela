<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    // -----------------------------------------
    // TAMPILKAN SEMUA PEMASOK
    // -----------------------------------------
    public function index()
{
    $pemasok = Pemasok::orderBy('idpemasok', 'desc')->paginate(10);
    $judul = "Daftar Pemasok";
    return view('pemasok.tabel', compact('pemasok', 'judul'));
}   
    // -----------------------------------------
    // FORM TAMBAH
    // -----------------------------------------
    public function create()
    {
        return view('pemasok.create');
    }

    // -----------------------------------------
    // SIMPAN DATA PEMASOK
    // -----------------------------------------    
    public function store(Request $request)
    {
    $validated = $request->validate([
        'kode' => 'required|string|max:50',
        'nama' => 'required|string|max:100',        
        'alamat' => 'required|string|max:100',
        'hp' => 'required|numeric|digits_between:8,18'
    ]);

    Pemasok::create([
        'kode' => $validated['kode'],
        'nama' => $validated['nama'],        
        'alamat' => $validated['alamat'],
        'hp' => $validated['hp'],
    ]);

    return redirect()->route('pemasok.index')->with('success', 'Data Pemasok berhasil ditambahkan!');
}
    // -----------------------------------------
    // FORM EDIT
    // -----------------------------------------
    public function edit($id)
    {
        $pemasok = Pemasok::findOrFail($id);
        return view('pemasok.edit', compact('pemasok'));
    }

    // -----------------------------------------
    // UPDATE DATA
    // -----------------------------------------
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
        ]);

        $pemasok = Pemasok::findOrFail($id);

        $pemasok->update([
            'kode'   => $request->kode,
            'nama'   => $request->nama,
            'alamat' => $request->alamat,
            'hp'   => $request->hp,
        ]);

        return redirect()->route('pemasok.index')
        ->with('success', 'Data pemasok berhasil diperbarui');
    }

    // -----------------------------------------
    // HAPUS DATA
    // -----------------------------------------
    public function destroy($id)
    {
        $pemasok = Pemasok::findOrFail($id);
        $pemasok->delete();

        return redirect()->route('pemasok.index')
        ->with('success', 'Data pemasok berhasil dihapus');
    }
}
