<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use illuminate\Http\Request;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Book $book)
{
    // Validasi data
    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
    ]);

    // Cari rating existing dari user yang sedang login
    $existingRating = $book->ratings()->where('users_id', Auth::id())->first();

    if ($existingRating) {
        // Update rating jika sudah ada
        $existingRating->update([
            'rating' => $validated['rating'],
        ]);
    } else {
        // Simpan rating baru jika belum ada
        $book->ratings()->create([
            'users_id' => Auth::id(),
            'rating' => $validated['rating'],
        ]);
    }

    // Redirect dengan pesan sukses
    return redirect()->route('buku.show', $book->id)->with('success', 'Rating berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
