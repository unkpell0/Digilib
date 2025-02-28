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
    public function store(Request $request, Book $buku)
    {   
        dd($request->all());
        // Validasi data: rating harus integer antara 1 dan 5, komentar wajib
        $validated = $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        // Cek apakah user sudah pernah memberikan rating untuk buku ini
        $existingRating = $buku->ratings()->where('user_id', Auth::id())->first();

        if ($existingRating) {
            // Jika sudah ada, update nilai rating
            $existingRating->update([
                'rating' => $validated['rating'],
            ]);
        } else {
            // Jika belum ada, buat rating baru
            $buku->ratings()->create([
                'user_id' => Auth::id(),
                'rating'   => $validated['rating'],
                // Pastikan kolom foreign key sesuai, misalnya jika menggunakan 'buku_id'
                'buku_id'  => $buku->id,
            ]);
        }

        // Simpan komentar baru
        $buku->comments()->create([
            'user_id' => Auth::id(),
            'komentar' => $validated['komentar'],
            'buku_id'  => $buku->id,
        ]);

        return redirect()->route('buku.show', $buku->id)
            ->with('success', 'Komentar dan rating berhasil disimpan!');
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
