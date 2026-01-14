<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    // 🧩 Menampilkan semua kategori
    public function index()
    {
        $data = DB::table('kategori')
            ->orderByDesc('idkategori')
            ->paginate(10);

        return view('kategori.tabel', [
            'judul' => 'Daftar Kategori',
            'data'  => $data
        ]);
    }

    // 🧩 Form tambah kategori
    public function create()
    {
        return view('kategori.form', [
            'judul' => 'Tambah Kategori',
            'kategori' => null
        ]);
    }

    // 🧩 Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:kategori,kode',
            'nama' => 'required|string|max:100',
            'keterangan' => 'nullable|string'
        ]);

        DB::table('kategori')->insert([
            'kode'        => $validated['kode'],
            'nama'        => $validated['nama'],
            'keterangan'  => $validated['keterangan'] ?? '',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil ditambahkan!');
    }

    // 🧩 Form edit kategori
    public function edit($id)
    {
        $kategori = DB::table('kategori')->where('idkategori', $id)->first();

        if (!$kategori) {
            return redirect()->route('kategori.index')->with('error', 'Data tidak ditemukan!');
        }

        return view('kategori.form', [
            'judul' => 'Edit Kategori',
            'kategori' => $kategori
        ]);
    }

    // 🧩 Update kategori
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:kategori,kode,' . $id . ',idkategori',
            'nama' => 'required|string|max:100',
            'keterangan' => 'nullable|string'
        ]);

        DB::table('kategori')->where('idkategori', $id)->update([
            'kode'        => $validated['kode'],
            'nama'        => $validated['nama'],
            'keterangan'  => $validated['keterangan'] ?? '',
            'updated_at'  => now()
        ]);

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil diperbarui!');
    }

    // 🧩 Hapus kategori
    public function destroy($id)
    {
        DB::table('kategori')->where('idkategori', $id)->delete();
        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil dihapus!');
    }
}
