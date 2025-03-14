<?php

namespace App\Models;

use App\Models\CartDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];
    protected $table = 'cart';
    public function details()
    {
        return $this->hasMany(CartDetail::class, 'cart_id');
    }
}
