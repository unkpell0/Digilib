<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rating;
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Ensure only authenticated users can access admin routes
    // }
    public function index(Request $request, $id = null)
    {
        $kategori = $request->query('kategori');

        if ($kategori) {
            $jumlah_kunjungan = Kategori::where('nama_kategori', $kategori)->first();

            if ($jumlah_kunjungan) {
                $jumlah_kunjungan->increment('jumlah_kunjungan');
            }

            // Ambil buku berdasarkan kategori
            $books = Book::whereHas('kategori', function ($query) use ($kategori) {
                $query->where('nama_kategori', $kategori);
            })->get();
        } else {
            // Ambil satu buku berdasarkan ID atau semua buku jika ID tidak ada
            $books = $id ? Book::where('id', $id)->get() : Book::all();
            $jumlah_kunjungan = null;
        }

        // Perbaikan: Gunakan `map()` agar nilai baru tersimpan di `$books`
        $books = $books->map(function ($book) {
            $book->averageRating = Rating::where('buku_id', $book->id)->avg('rating') ?? 0;
            $book->totalRaters = Rating::where('buku_id', $book->id)->count();
            return $book;
        });

        return view('dashboard', compact('books', 'jumlah_kunjungan'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function rateBook(Request $request, $buku_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $userId = auth()->id(); // ID user yang login

        // Cek apakah user sudah memberi rating pada buku ini
        $existingRating = Rating::where('buku_id', $buku_id)->where('user_id', $userId)->first();

        if (!$existingRating) {
            // Jika belum ada, simpan rating baru
            Rating::create([
                'buku_id' => $buku_id,
                'user_id' => $userId,
                'rating' => $request->input('rating'),
            ]);
        }

        // Hitung rata-rata rating setelah update
        // $averageRating = Rating::where('buku_id', $buku_id)->avg('rating');

        return redirect()->route('buku.show', ['id' => $buku_id])
            ->with('success', 'Terimakasih atas rating Anda!');
    }

    public function show(string $id)
    {
        $komentview = Komentar::where('buku_id', $id)->count();

        // Ambil buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Increment jumlah views
        $book->increment('views');

        // Cek apakah user sudah membeli buku dengan transaksi sukses
        $hasPurchased = false;
        if (auth()->check()) {
            $hasPurchased = Transaksi::where('user_id', auth()->id())
                ->where('buku_id', $id)
                ->where('status', 'success') // Sesuaikan dengan nama kolom di database
                ->exists();
        }
        $averageRating = Rating::where('buku_id', $id)->avg('rating');
        $totalRaters = Rating::where('buku_id', $id)->count();
        // Return ke view detail buku
        return view('user.showbook', compact('book', 'hasPurchased', 'komentview', 'averageRating', 'totalRaters'));
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(Request $request)
    {
        // Ambil term pencarian dari query string
        $searchTerm = $request->input('search');

        // Query untuk mencari berdasarkan nama_buku, penulis, atau nama_genre
        $books = DB::table('buku')
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
        return view('result', compact('books', 'searchTerm'));
    }


    public function mybook()
    {
        return view('user.mybook');
    }
}
