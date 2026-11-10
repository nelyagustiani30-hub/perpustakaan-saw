<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 'judul', 'penulis', 'kategori',
        'jumlah_dipinjam', 'rating', 'tahun_terbit', 'stok', 'kondisi_rusak',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}