<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukugenre extends Model
{
    use HasFactory;

    protected $table = 'bukugenre';

    protected $fillable = [
        'buku_id',
        'genre_id',
    ];
}
