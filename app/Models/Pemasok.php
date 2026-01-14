<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    protected $table = 'pemasok';

    protected $primaryKey = 'idpemasok';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'nama',
        'alamat',
        'hp',
    ];
}
