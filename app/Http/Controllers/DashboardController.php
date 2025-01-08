<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        // Cek apakah ada parameter kategori yang dikirim
        $kategori = $request->query('kategori');

        if ($kategori) {
            // Filter berdasarkan kategori jika parameter kategori ada
            $books = Book::whereHas('kategori', function ($query) use ($kategori) {
                $query->where('nama_kategori', $kategori);
            })->get();
        } else {
            // Tampilkan semua buku jika parameter kategori tidak ada
            $books = Book::all();
        }

        return view('dashboard', compact('books'));
    }
}
