<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;
    protected $table = 'cart_detail';
    protected $fillable = ['cart_id', 'buku_id', 'buku_name', 'harga', 'quantity'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class, 'buku_id', 'id');
    }
}
