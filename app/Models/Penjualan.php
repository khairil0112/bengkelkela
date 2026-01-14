<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
   protected $fillable = ['nota','tanggal','pelanggan_id','mekanik_id','kendaraan'];

    public function pelanggan()
{
    return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
}

public function mekanik()
{
    return $this->belongsTo(Mekanik::class, 'mekanik_id');
}

    public function detail()
{
    return $this->hasMany(Detail_transaksi::class, 'transaksi_id');
}

}
