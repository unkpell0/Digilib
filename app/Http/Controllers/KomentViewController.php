<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentViewController extends Controller
{
    public function showRateKoment($id)
    {
        $buku = Book::with(['comments.user'])->findOrFail($id);

        // Mengirim data buku dan komentar ke view
        return view('user.komentar-rate', compact('buku'));
    }
}
