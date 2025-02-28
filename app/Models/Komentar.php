<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $table = 'komentar';
    protected $fillable = ['buku_id', 'user_id', 'komentar', 'reply_id','replied_to_username'];
    public function buku()
    {
        return $this->belongsTo(Book::class);
    }

    public function replies()
    {
        return $this->hasMany(Komentar::class, 'reply_id');
    }

    public function parent()
    {
        return $this->belongsTo(Komentar::class, 'reply_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
