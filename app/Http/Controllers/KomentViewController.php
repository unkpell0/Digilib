<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentViewController extends Controller
{
    public function showRateKoment($id)
    {
        $buku = Book::with(['comments.user', 'ratings'])->findOrFail($id);
        // Hitung rata-rata rating, misalnya:
        $buku->averageRating = $buku->ratings->avg('rating');
        return view('user.komentar-rate', ['buku_id' => $id], compact('buku'));
    }
    public function store(Request $request, Book $buku)
    {
        // Pastikan untuk menghapus atau mengomentari dd() ketika sudah diuji
        // dd($request->all());

        // Validasi data
        $validated = $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        // Cek apakah user sudah pernah memberikan rating untuk buku ini
        $existingRating = $buku->ratings()->where('user_id', Auth::id())->first();

        if ($existingRating) {
            // Update rating jika sudah ada
            $existingRating->update([
                'rating' => $validated['rating'],
            ]);
        } else {
            // Buat rating baru jika belum ada
            $buku->ratings()->create([
                'user_id' => Auth::id(),
                'rating'  => $validated['rating'],
                'buku_id' => $buku->id,
            ]);
        }

        // Simpan komentar baru
        $buku->comments()->create([
            'user_id'  => Auth::id(),
            'komentar' => $validated['komentar'],
            'buku_id'  => $buku->id,
        ]);

        return redirect()->route('buku.show', $buku->id)
            ->with('success', 'Komentar dan rating berhasil disimpan!');
    }
}
