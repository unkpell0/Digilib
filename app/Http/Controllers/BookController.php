<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
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
        return view('admin.book.crud.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'book_cover' => 'nullable|image|mimes:jpeg,png,jpg', // 2MB max for images
            'pdf_file' => 'nullable|mimes:pdf', // 10MB max for PDFs
        ]);

        // Handle file uploads with hashing
        $bookCoverPath = $request->file('book_cover')
            ? $request->file('book_cover')->storeAs('book_covers', Str::random(40) . '.' . $request->file('book_cover')->extension(), 'public')
            : null;

        $pdfFilePath = $request->file('pdf_file')
            ? $request->file('pdf_file')->storeAs('pdf_files', Str::random(40) . '.' . $request->file('pdf_file')->extension(), 'public')
            : null;

        // Store book data with file paths
        Book::create([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'publisher' => $validatedData['publisher'],
            'genre' => $validatedData['genre'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],
            'book_cover' => $bookCoverPath,
            'pdf_file' => $pdfFilePath,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('admin.book.crud.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        // Validate request
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'publisher' => 'required|string|max:255',
        'genre' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'category' => 'required|string|max:255',
        'book_cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB max for images
        'pdf_file' => 'nullable|mimes:pdf|max:10000', // 10MB max for PDFs
    ]);

    // Update file paths if new files are uploaded
    if ($request->hasFile('book_cover')) {
        // Delete old book cover if it exists
        if ($book->book_cover && Storage::disk('public')->exists($book->book_cover)) {
            Storage::disk('public')->delete($book->book_cover);
        }

        // Store new book cover with hashed name
        $bookCoverPath = $request->file('book_cover')->storeAs(
            'book_covers', 
            Str::random(40) . '.' . $request->file('book_cover')->extension(), 
            'public'
        );
        $book->book_cover = $bookCoverPath;
    }

    if ($request->hasFile('pdf_file')) {
        // Delete old PDF file if it exists
        if ($book->pdf_file && Storage::disk('public')->exists($book->pdf_file)) {
            Storage::disk('public')->delete($book->pdf_file);
        }

        // Store new PDF file with hashed name
        $pdfFilePath = $request->file('pdf_file')->storeAs(
            'pdf_files', 
            Str::random(40) . '.' . $request->file('pdf_file')->extension(), 
            'public'
        );
        $book->pdf_file = $pdfFilePath;
    }

    // Update other book details
    $book->title = $validatedData['title'];
    $book->author = $validatedData['author'];
    $book->publisher = $validatedData['publisher'];
    $book->genre = $validatedData['genre'];
    $book->price = $validatedData['price'];
    $book->description = $validatedData['description'];
    $book->category = $validatedData['category'];

    // Save updated book
    $book->save();

    return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->book_cover) {
            Storage::disk('public')->delete($book->book_cover);
        }

        if ($book->file_pdf) {
            Storage::disk('public')->delete($book->file_pdf);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully');

    }
}
