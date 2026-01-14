<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartController extends Controller
{
    // 🧩 Menampilkan semua data part & jasa
    public function index()
    {
        $data = DB::table('partdanjasa')
            ->leftJoin('kategori', 'kategori.idkategori', '=', 'partdanjasa.idkategori')
            ->leftJoin('satuan', 'satuan.idsatuan', '=', 'partdanjasa.idsatuan')
            ->leftJoin('jenis', 'jenis.idjenis', '=', 'partdanjasa.idjenis')
            
            ->select(
                'partdanjasa.*',
                'kategori.nama as namakategori',
                'satuan.nama as namasatuan',
                'jenis.nama as namajenis'
            )
            ->orderByDesc('partdanjasa.id')
            ->paginate(10);

        // kirim juga data dropdown untuk modal tambah
        $kategori = DB::table('kategori')->get();
        $satuan = DB::table('satuan')->get();
        $jenis = DB::table('jenis')->get();

        return view('partdanjasa.tabel', [
            'judul' => 'Daftar Part & Jasa',
            'data' => $data,
            'kategori' => $kategori,
            'satuan' => $satuan,
            'jenis' => $jenis
        ]);
    }
    
    // 🧩 Form tambah part & jasa
    public function create()
    {
        $kategori = DB::table('kategori')->get();
        $satuan = DB::table('satuan')->get();
        $jenis = DB::table('jenis')->get();

        return view('partdanjasa.form', [
            'judul' => 'Tambah Part/Jasa',
            'kategori' => $kategori,
            'satuan' => $satuan,
            'jenis' => $jenis,
            'part' => null
        ]);
    }

    // 🧩 Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50',
            'nama' => 'required|string|max:50',
            'idsatuan' => 'required|integer',
            'idjenis' => 'required|integer',
            'idkategori' => 'required|integer',
            'noseri' => 'nullable|string|max:50',
            'stokawal' => 'required|integer|min:0',
            'hargaawal' => 'required|integer|min:0',
            'hargarata' => 'required|integer|min:0',
            'hbterakhir' => 'required|integer|min:0'
        ]);

        DB::table('partdanjasa')->insert([
            'kode'        => $validated['kode'],
            'nama'        => $validated['nama'],
            'idsatuan'    => $validated['idsatuan'],
            'idjenis'     => $validated['idjenis'],
            'idkategori'  => $validated['idkategori'],
            'noseri'      => $validated['noseri'] ?? '',
            'stokawal'    => $validated['stokawal'],
            'hargaawal'   => $validated['hargaawal'],
            'hargarata'   => $validated['hargarata'],
            'hbterakhir'  => $validated['hbterakhir'],
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        
        // dd($request);
        return redirect()->route('part.index')->with('success', 'Data part berhasil ditambahkan!');
    }

    // 🧩 Form edit
    public function edit($id)
    {
        $part = DB::table('partdanjasa')->where('id', $id)->first();
        if (!$part) {
            return redirect()->route('part.index')->with('error', 'Data tidak ditemukan!');
        }

        $kategori = DB::table('kategori')->get();
        $satuan = DB::table('satuan')->get();
        $jenis = DB::table('jenis')->get();

        return view('partdanjasa.edit', [
            'judul' => 'Edit Data Part/Jasa',
            'part' => $part,
            'kategori' => $kategori,
            'satuan' => $satuan,
            'jenis' => $jenis
        ]);
    }

    // 🧩 Update data
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50',
            'nama' => 'required|string|max:50',
            'idsatuan' => 'required|integer',
            'idjenis' => 'required|integer',
            'idkategori' => 'required|integer',
            'noseri' => 'nullable|string|max:50',
            'stokawal' => 'required|integer|min:0',
            'hargaawal' => 'required|integer|min:0',
            'hargarata' => 'required|integer|min:0',
            'hbterakhir' => 'required|integer|min:0'
        ]);

        DB::table('partdanjasa')->where('id', $id)->update([
            'kode'        => $validated['kode'],
            'nama'        => $validated['nama'],
            'idsatuan'    => $validated['idsatuan'],
            'idjenis'     => $validated['idjenis'],
            'idkategori'  => $validated['idkategori'],
            'noseri'      => $validated['noseri'] ?? '',
            'stokawal'    => $validated['stokawal'],
            'hargaawal'   => $validated['hargaawal'],
            'hargarata'   => $validated['hargarata'],
            'hbterakhir'  => $validated['hbterakhir'],
            'updated_at'  => now(),
        ]);

        return redirect()->route('part.index')->with('success', 'Data berhasil diperbarui!');
    }

    // 🧩 Hapus data
    public function destroy($id)
    {
        DB::table('partdanjasa')->where('id', $id)->delete();
        return redirect()->route('part.index')->with('success', 'Data berhasil dihapus!');
    }
}
