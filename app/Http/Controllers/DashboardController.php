<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request,$id = null){
        // Cek apakah ada parameter kategori yang dikirim
        $kategori = $request->query('kategori');

        if ($kategori) {
            // Filter berdasarkan kategori jika parameter kategori ada
            $books = Book::whereHas('kategori', function ($query) use ($kategori) {
                $query->where('nama_kategori', $kategori);
            })->get();
        } else {
            // Tampilkan semua buku jika parameter kategori tidak ada
            $books = $id ? Book::where('id', $id)->get() : Book::all();
        }
        $books = $books->map(function ($book) {
            $book->averageRating = Rating::where('buku_id', $book->id)->avg('rating') ?? 0;
            $book->totalRaters = Rating::where('buku_id', $book->id)->count();
            return $book;
        });
        return view('dashboard', compact('books'));
    }
}
