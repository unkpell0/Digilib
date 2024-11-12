<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'nama_buku',
        'penulis',
        'deskripsi',
        'rating',
        'harga',
        'image_cover',
        'file_buku',
        'kategori_id',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'bukugenre', 'buku_id', 'genre_id')
                    ->withTimestamps();
    }
    public function kategori()
{
    return $this->belongsTo(Kategori::class, 'kategori_id');
}
}
