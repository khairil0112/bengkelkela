<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'kode',
        'nama',
        'nopol',
        'namamotor',
        'tahun',
        'alamat',
        'hp'
    ];
}
