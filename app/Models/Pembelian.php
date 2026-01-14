<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';

    public $timestamps = false;

    protected $fillable = [
        'kode_pembelian',
        'tanggal_pembelian',
        'idpemasok',
        'keterangan',
        'total_harga',
        'diskon',
        'pajak',
        'grand_total',
    ];

    /**
     * Relasi ke detail pembelian
     */
    public function details()
    {
        return $this->hasMany(
            Detail_transaksi::class,
            'id_transaksi',
            'id_pembelian'
        );
    }

    /**
     * Relasi ke pemasok
     */
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'idpemasok', 'idpemasok');
    }
}
