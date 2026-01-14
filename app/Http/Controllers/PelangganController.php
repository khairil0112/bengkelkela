<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // TAMPILKAN SEMUA DATA
   public function index()
{
    $data = Pelanggan::orderBy('id', 'desc')->paginate(10);
    $judul = "Daftar Pelanggan";
    return view('pelanggan.tabel', compact('data', 'judul'));
}


    // FORM TAMBAH
    public function create()
    {
        return view('pelanggan.create');
    }

   
    public function store(Request $request)
{
    $validated = $request->validate([
        'kode' => 'required|string|max:50',
        'nama' => 'required|string|max:50',
        'namamotor' => 'required|string|max:50',
        'nopol' => 'required|string|max:50',
        'tahun' => 'required|integer',
        'alamat' => 'required|string|max:50',
        'hp' => 'required|string|max:20',
    ]);

    Pelanggan::create([
        'kode' => $validated['kode'],
        'nama' => $validated['nama'],
        'namamotor' => $validated['namamotor'],
        'nopol' => $validated['nopol'],
        'tahun' => $validated['tahun'],
        'alamat' => $validated['alamat'],
        'hp' => $validated['hp'],
    ]);

    return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan!');
}


    // FORM EDIT
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'nopol' => 'required',
            'namamotor' => 'required',
            'tahun' => 'required',
            'alamat' => 'required',
            'hp' => 'required'
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diupdate.');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
