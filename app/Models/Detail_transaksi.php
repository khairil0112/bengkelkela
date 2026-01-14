<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_transaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $fillable = [
        'transaksi_id',     // foreign key ke tabel penjualans
        'partjasa_id',      // foreign key ke tabel partdanjasa
        'qty',
        'harga',
        'subtotal',
    ];

    // relasi ke penjualan
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id');
    }

    // relasi ke part/jasa
    public function part()
    {
        return $this->belongsTo(Partdanjasa::class, 'partjasa_id');
    }
    
}
