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

        return redirect()->route('ratekoment', $buku->id)
            ->with('success', 'Komentar dan rating berhasil disimpan!');
    }
    public function update(Request $request, Book $buku)
    {
        // Validasi data
        $validated = $request->validate([
            'rating'     => 'required|integer|min:1|max:5',
            'komentar'   => 'required|string',
            'komentar_id' => 'required|exists:komentar,id'
        ]);

        // Update rating
        $existingRating = $buku->ratings()->where('user_id', Auth::id())->first();
        if ($existingRating) {
            $existingRating->update([
                'rating' => $validated['rating'],
            ]);
        } else {
            // Buat rating baru jika belum ada (seharusnya ini tidak terjadi)
            $buku->ratings()->create([
                'user_id' => Auth::id(),
                'rating'  => $validated['rating'],
                'buku_id' => $buku->id,
            ]);
        }

        // Update komentar
        $komentar = Komentar::where('id', $validated['komentar_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $komentar->update([
            'komentar' => $validated['komentar']
        ]);

        return redirect()->route('ratekoment', $buku->id)
            ->with('success', 'Komentar dan rating berhasil diperbarui!');
    }

    public function deleteComment(Komentar $komentar)
    {
        // Cek apakah komentar milik user yang login
        if ($komentar->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }

        $bukuId = $komentar->buku_id;
        $komentar->delete();

        return redirect()->route('ratekoment', $bukuId)
            ->with('success', 'Komentar berhasil dihapus!');
    }
    public function replyComment(Request $request, Komentar $komentar)
    {
        $validated = $request->validate([
            'komentar' => 'required|string',
            'replied_username' => 'nullable|string'
        ]);

        $newKomentar = new Komentar([
            'user_id' => Auth::id(),
            'buku_id' => $komentar->buku_id,
            'komentar' => $validated['komentar'],
            'reply_id' => $komentar->id,
            'replied_to_username' => $validated['replied_username'] // Simpan username yang dibalas
        ]);

        $newKomentar->save();

        return back()->with('success', 'Balasan berhasil dikirim!');
    }

    public function updateComment(Request $request, Komentar $komentar)
    {
        // Cek apakah komentar milik user yang login
        if ($komentar->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki izin untuk mengedit komentar ini.');
        }

        $validated = $request->validate([
            'komentar' => 'required|string'
        ]);

        $komentar->update([
            'komentar' => $validated['komentar']
        ]);

        return back()->with('success', 'Komentar berhasil diperbarui!');
    }
}
