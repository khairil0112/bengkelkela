<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis';

    protected $primaryKey = 'idjenis';
    public $timestamps = false;

    protected $fillable = [        
        'nama',        
    ];
}
