<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mekanik extends Model
{
    protected $table = 'mekanik';

    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'namamk',
        'alamat',
        'hp',
    ];
}
