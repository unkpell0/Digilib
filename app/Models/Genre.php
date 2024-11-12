<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genre';

    protected $fillable = [
        'nama_genre',
        'deskripsi',
        'slug',
        'views',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'bukugenre', 'genre_id', 'buku_id')
                    ->withTimestamps();
    }
}
