<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class BukuUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth'); // Ensure only authenticated users can access admin routes
    }
    public function index(Request $request)
    {
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

    /**
     * Show the form for creating a new resource.
     */

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);

    // Cek apakah user sudah membeli buku dengan transaksi sukses
    $hasPurchased = false;
    if (auth()->check()) {
        $hasPurchased = Transaksi::where('user_id', auth()->id())
            ->where('buku_id', $id)
            ->where('status', 'success') // Sesuaikan dengan nama kolom di database
            ->exists();
    }

    return view('user.showbook', compact('book', 'hasPurchased'));
    }

    /**
     * Show the form for editing the specified resource.
     */
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
    
    // Filter buku berdasarkan nama buku yang sesuai dengan search term
    $books = Book::where('nama_buku', 'LIKE', '%' . $searchTerm . '%')->get();

    return view('result', compact('books', 'searchTerm'));
}


}
