<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $book = Book::findOrFail($id);
        $transaksi = Transaksi::where('user_id', Auth::id())->get();
        return view('user.transaksi', compact('transaksi', 'book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $book = Book::findOrFail($id);
        $biaya_admin = 2000; // Biaya admin tetap
        $total_harga = $book->harga + $biaya_admin;

        return view('user.transaksi', compact('book', 'biaya_admin', 'total_harga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:Gopay,BCA,BNI,Maestro',
        ]);

        $book = Book::findOrFail($id);
        $biayaAdmin = 2000; // Biaya admin tetap
        $totalHarga = $book->harga + $biayaAdmin;

        $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'buku_id' => $book->id,
            'total_harga' => $totalHarga,
            'status' => 'pending',
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect()->route('transaksi.show', $transaksi->id)
            ->with('success', 'Transaksi berhasil dibuat! Silakan lakukan pembayaran.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaksi = Transaksi::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $book = $transaksi->buku; // Relasi 'buku' harus ada di model Transaksi.

        return view('user.transaksishow', compact('transaksi', 'book'));
    }
    public function checkout(Request $request, $id)
    {
        // Ambil transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Validasi bahwa transaksi milik user yang sedang login
        if ($transaksi->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Ubah status transaksi menjadi 'success'
        $transaksi->update([
            'status' => 'success',
            'tanggal_transaksi' => now()
        ]);

        // Redirect kembali ke halaman transaksi
        return redirect()->route('transaksi.show', $id)
            ->with('success', 'Transaksi berhasil! Buku dapat dilihat sekarang.');
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
}
