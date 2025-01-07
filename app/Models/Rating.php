<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'rating'; // Nama tabel harus sesuai dengan database
    protected $fillable = [
        'users_id', 
        'buku_id', 
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id'); // Pastikan foreign key benar
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'buku_id'); // Pastikan foreign key benar
    }
}