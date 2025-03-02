<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExploreController extends Controller
{
    public function explore(Request $request)
    {
        $query = Book::with('genres'); // Eager loading genres relation

        // Mengambil semua genre untuk dropdown filter
        $genres = Genre::all();

        // Filter berdasarkan genre (jika tersedia)
        if ($request->has('genre') && $request->genre !== null) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('nama_genre', $request->genre);
            });
        }

        // Filter berdasarkan status (jika tersedia)
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tipe (jika tersedia)
        if ($request->has('type') && $request->type !== null) {
            $query->where('type', $request->type);
        }

        // Filter berdasarkan rentang harga (jika tersedia)
        if ($request->has('min_price') && $request->min_price !== null) {
            $query->where('harga', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price !== null) {
            $query->where('harga', '<=', $request->max_price);
        }

        // Add subqueries for average rating and total raters
        $query->selectRaw(
            'buku.*, 
        (SELECT AVG(rating) FROM rating WHERE buku_id = buku.id) as averageRating,
        (SELECT COUNT(*) FROM rating WHERE buku_id = buku.id) as totalRaters'
        );

        // Sort by berdasarkan parameter
        if ($request->has('sort_by') && $request->sort_by !== null) {
            $sortBy = $request->sort_by;
            switch ($sortBy) {
                case 'rating':
                    $query->orderByDesc('averageRating'); // Using the calculated field
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'popular':
                    $query->withCount('views')
                        ->orderByDesc('views_count');
                    break;
                case 'price_low':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('harga', 'desc');
                    break;
                default:
                    $query->orderBy('nama_buku', 'asc');
                    break;
            }
        } else {
            // Default sorting jika tidak ada parameter sort
            $query->orderBy('created_at', 'desc');
        }

        // Dapatkan hasil setelah semua filter
        $books = $query->paginate(15);

        // Kirimkan hasil ke view explore
        return view('explore', compact('books', 'genres'));
    }
    public function filterByGenre($genreName)
    {
        // Cari genre berdasarkan nama
        $genre = Genre::where('nama_genre', $genreName)->firstOrFail();

        // Tambahkan jumlah views
        $genre->increment('views');

        // Ambil buku-buku yang memiliki genre ini
        $books = Book::whereHas('genres', function ($query) use ($genre) {
            $query->where('genre_id', $genre->id);
        })->with('genres')->get();

        // Ambil semua genre untuk dropdown
        $genres = Genre::withCount('books as buku_count')->get();

        // Redirect ke halaman explore dengan parameter genre
        return view('explore', compact('books', 'genres', 'genre'));
    }
    public function search(Request $request)
    {
        // Ambil term pencarian dari query string
        $searchTerm = $request->input('search');

        // Query untuk mencari berdasarkan nama_buku, penulis, atau nama_genre
        $books = Book::with('genres')
            ->leftJoin('bukugenre', 'buku.id', '=', 'bukugenre.buku_id')
            ->leftJoin('genre', 'bukugenre.genre_id', '=', 'genre.id')
            ->where('buku.nama_buku', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('buku.penulis', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('genre.nama_genre', 'LIKE', '%' . $searchTerm . '%')
            ->select('buku.*')
            ->distinct()
            ->get();
        $books = $books->map(function ($book) {
            $book->averageRating = DB::table('rating')->where('buku_id', $book->id)->avg('rating') ?? 0;
            $book->totalRaters = DB::table('rating')->where('buku_id', $book->id)->count();
            return $book;
        });
        return view('explore', compact('books', 'searchTerm'));
    }
}
