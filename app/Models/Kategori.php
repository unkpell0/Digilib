<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = [
        'nama_kategori',
        'jumlah_kunjungan',
    ];
    public function incrementVisitCount()
    {
        $this->increment('jumlah_kunjungan');
    }
}
