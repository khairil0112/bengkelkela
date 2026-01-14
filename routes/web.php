<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembelianController;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/', [WelcomeController::class, 'welcome'])->name('welcome');
// part
Route::get('/part', [PartController::class, 'index'])->name('part.index');
Route::post('/part', [PartController::class, 'index'])->name('part.index');
Route::post('/part/store', [PartController::class, 'store'])->name('part.store');
Route::get('/part/edit/{id}', [PartController::class, 'edit'])->name('part.edit');
Route::post('/part/update/{id}', [PartController::class, 'update'])->name('part.update'); // edit
Route::post('/part/delete/{id}', [PartController::class, 'destroy'])->name('part.delete'); // hapus

// Pelanggan
Route::post('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggan/edit/{id}', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::post('/pelanggan/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::post('/pelanggan/destroy/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

// Pemasok
Route::post('/pemasok', [PemasokController::class, 'index'])->name('pemasok.index');
Route::get('/pemasok', [PemasokController::class, 'index'])->name('pemasok.index');
Route::get('/pemasok/create', [PemasokController::class, 'create'])->name('pemasok.create');
Route::post('/pemasok/store', [PemasokController::class, 'store'])->name('pemasok.store');
Route::get('/pemasok/edit/{id}', [PemasokController::class, 'edit'])->name('pemasok.edit');
Route::post('/pemasok/update/{id}', [PemasokController::class, 'update'])->name('pemasok.update');
Route::post('/pemasok/destroy/{id}', [PemasokController::class, 'destroy'])->name('pemasok.destroy');

// Pemasok
Route::post('/mekanik', [MekanikController::class, 'index'])->name('mekanik.index');
Route::get('/mekanik', [MekanikController::class, 'index'])->name('mekanik.index');
Route::get('/mekanik/create', [MekanikController::class, 'create'])->name('mekanik.create');
Route::post('/mekanik/store', [MekanikController::class, 'store'])->name('mekanik.store');
Route::get('/mekanik/edit/{id}', [MekanikController::class, 'edit'])->name('mekanik.edit');
Route::post('/mekanik/update/{id}', [MekanikController::class, 'update'])->name('mekanik.update');
Route::post('/mekanik/destroy/{id}', [MekanikController::class, 'destroy'])->name('mekanik.destroy');

// Route::resource('pelanggan', PelangganController::class);
// Route::resource('pemasok', PemasokController::class);

Route::post('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
Route::post('/penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');
Route::get('/penjualan/edit/{id}', [PenjualanController::class, 'edit'])->name('penjualan.edit');
Route::post('penjualan/update/{id}', [PenjualanController::class, 'update']);
Route::post('/penjualan/destroy/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
Route::post('/penjualan/detail/{id}', function ($id) {
    $transaksi = \App\Models\Penjualan::with(['pelanggan', 'mekanik', 'detail.part'])->findOrFail($id);
    return view('penjualan.detail', compact('transaksi'));
});
Route::get(
    'penjualan/cetak/{id}',
    [App\Http\Controllers\PenjualanController::class, 'cetak']
)->name('penjualan.cetak');

// Halaman Rekap Penjualan (summary)
Route::post('/laporan/rekap', [LaporanController::class, 'rekap'])
    ->name('laporan.rekap');

// Halaman Detail Penjualan (master–detail)
Route::get('/laporan/detail/{tanggal}', [LaporanController::class, 'detail'])
    ->name('laporan.detail');
Route::get('/laporan/penjualan/print', [LaporanController::class, 'print'])
    ->name('laporan.penjualan.print');
Route::get(
    '/laporan/penjualan',
    [LaporanController::class, 'rekap']
)->name('laporan.penjualan');

Route::get(
    '/laporan/penjualan/print',
    [LaporanController::class, 'print']
)->name('laporan.penjualan.print');

Route::post('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
Route::get('/pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create');
Route::post('/pembelian/store', [PembelianController::class, 'store'])->name('pembelian.store');
Route::get('/pembelian/show/{id}', [PembelianController::class, 'show'])->name('pembelian.show');
Route::get('/pembelian/edit/{id}', [PembelianController::class, 'edit'])->name('pembelian.edit');
Route::post('pembelian/update/{id}', [PembelianController::class, 'update']);
Route::post('/pembelian/destroy/{id}', [PembelianController::class, 'destroy'])->name('pembelian.destroy');
Route::post('/pembelian/detail/{id}', function ($id) {
    $transaksi = \App\Models\Pembelian::with(['pelanggan', 'mekanik', 'detail.part'])->findOrFail($id);
    return view('pembelian.detail', compact('transaksi'));
});
Route::get(
    'pembelian/cetak/{id}',
    [App\Http\Controllers\PembelianController::class, 'cetak']
)->name('pembelian.cetak');
