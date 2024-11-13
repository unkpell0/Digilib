<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Bukugenre;
use App\Models\Genre;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all(); // Mengambil semua data genre
        $kategoris = Kategori::all(); // Mengambil semua data kategori

        return view('admin.book.add', compact('genres', 'kategoris'));;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'harga' => 'required|string',
            'genres' => 'required|array',
            'genres.*' => 'exists:genre,id',
            'kategori_id' => 'required|exists:kategori,id',
            'image_cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_buku' => 'nullable|mimes:pdf|max:10000',
        ]);

        // Handle file uploads with hashing
        $imageCoverPath = $request->file('image_cover')
            ? $request->file('image_cover')->storeAs('book_covers', Str::random(40) . '.' . $request->file('image_cover')->extension(), 'public')
            : null;

        $fileBukuPath = $request->file('file_buku')
            ? $request->file('file_buku')->storeAs('pdf_files', Str::random(40) . '.' . $request->file('file_buku')->extension(), 'public')
            : null;

        // Create the book record
        $book = Book::create([
            'nama_buku' => $request['nama_buku'],
            'penulis' => $request['penulis'],
            'deskripsi' => $request['deskripsi'],
            'rating' => $request['rating'],
            'harga' => $request['harga'],
            'kategori_id' => $request['kategori_id'],
            'image_cover' => $imageCoverPath,
            'file_buku' => $fileBukuPath,
        ]);

        // Attach the genres to the book using the genres array from the request
        $book->genres()->attach($request->genres);

        return redirect()->route('buku.index')->with('success', 'Book created successfully.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book, $id)
    {
        $books = Book::findOrFail($id);
        $genres = Genre::all();
        $kategoris = Kategori::all();
        return view('admin.book.edit', compact('books', 'genres', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'harga' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'image_cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_buku' => 'nullable|mimes:pdf|max:10000',
            'genres' => 'required|array',
            'genres.*' => 'exists:genre,id',
        ]);

        $book = Book::findOrFail($id);
        // Jika ada file image_cover yang diupload, simpan file baru
        if ($request->hasFile('image_cover')) {
            if ($book->image_cover && Storage::disk('public')->exists($book->image_cover)) {
                Storage::disk('public')->delete($book->image_cover);
            }
            $imageCoverPath = $request->file('image_cover')->storeAs(
                'book_covers',
                Str::random(40) . '.' . $request->file('image_cover')->extension(),
                'public'
            );
            $book->image_cover = $imageCoverPath;
        }

        // Jika ada file file_buku yang diupload, simpan file baru
        if ($request->hasFile('file_buku')) {
            if ($book->file_buku && Storage::disk('public')->exists($book->file_buku)) {
                Storage::disk('public')->delete($book->file_buku);
            }
            $fileBukuPath = $request->file('file_buku')->storeAs(
                'pdf_files',
                Str::random(40) . '.' . $request->file('file_buku')->extension(),
                'public'
            );
            $book->file_buku = $fileBukuPath;
        }

        // Update kolom lainnya
        $book->nama_buku = $request->input('nama_buku');
        $book->penulis = $request->input('penulis');
        $book->deskripsi = $request->input('deskripsi');
        $book->rating = $request->input('rating');
        $book->harga = $request->input('harga');
        $book->kategori_id = $request->input('kategori_id');

        // Simpan perubahan ke database
        $book->update();

        // Sinkronisasi genres
        $book->genres()->sync($request->input('genres'));

        return redirect()->route('buku.index')->with('success', 'Book updated successfully.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->image_cover && Storage::disk('public')->exists($book->image_cover)) {
            Storage::disk('public')->delete($book->image_cover);
        }
        if ($book->file_buku && Storage::disk('public')->exists($book->file_buku)) {
            Storage::disk('public')->delete($book->file_buku);
        }
        $book->delete();
        return redirect()->route('buku.index')->with('success', 'Book deleted successfully');
    }
}
