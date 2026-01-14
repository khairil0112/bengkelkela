<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partdanjasa extends Model
{
    use HasFactory;

    protected $table = 'partdanjasa'; // nama tabel di DB

    protected $fillable = [
        'kode',
        'nama',
        'idsatuan',
        'idkategori',
        'idjenis',
        'noseri',
        'stokawal',
        'hargaawal',
        'hargarata',
        'hbterakhir',
    ];

    // Jika ingin relasi, ini opsional:
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'idsatuan');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori');
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'idjenis');
    }
}
