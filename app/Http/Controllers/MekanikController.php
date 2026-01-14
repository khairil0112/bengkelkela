<?php

namespace App\Http\Controllers;
use App\Models\Mekanik;
use Illuminate\Http\Request;

class MekanikController extends Controller
{
    public function index()
{
    $mekanik = Mekanik::orderBy('id', 'desc')->paginate(10);
    $judul = "Daftar Mekanik";
    return view('mekanik.tabel', compact('mekanik', 'judul'));
}   
    // -----------------------------------------
    // FORM TAMBAH
    // -----------------------------------------
    public function create()
    {
        return view('mekanik.create');
    }

    // -----------------------------------------
    // SIMPAN DATA PEMASOK
    // -----------------------------------------    
    public function store(Request $request)
    {
    $validated = $request->validate([
        'kode' => 'required|string|max:50',
        'namamk' => 'required|string|max:100',        
        'alamat' => 'required|string|max:100',
        'hp' => 'required|numeric|digits_between:8,18'
    ]);

    Mekanik::create([
        'kode' => $validated['kode'],
        'namamk' => $validated['namamk'],        
        'alamat' => $validated['alamat'],
        'hp' => $validated['hp'],
    ]);

    return redirect()->route('mekanik.index')->with('success', 'Data Mekanik berhasil ditambahkan!');
}
    // -----------------------------------------
    // FORM EDIT
    // -----------------------------------------
    public function edit($id)
    {
        $mekanik = Mekanik::findOrFail($id);
        return view('mekanik.edit', compact('mekanik'));
    }

    // -----------------------------------------
    // UPDATE DATA
    // -----------------------------------------
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'namamk' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
        ]);

        $mekanik = Mekanik::findOrFail($id);

        $mekanik->update([
            'kode'   => $request->kode,
            'namamk'   => $request->namamk,
            'alamat' => $request->alamat,
            'hp'   => $request->hp,
        ]);

        return redirect()->route('mekanik.index')
        ->with('success', 'Data Mekanik berhasil diperbarui');
    }

    // -----------------------------------------
    // HAPUS DATA
    // -----------------------------------------
    public function destroy($id)
    {
        $mekanik = Mekanik::findOrFail($id);
        $mekanik->delete();

        return redirect()->route('mekanik.index')
        ->with('success', 'Data Mekanik berhasil dihapus');
    }
}
