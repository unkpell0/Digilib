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
        return view('user.transaksi', compact('transaksi','book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $book = Book::findOrFail($id);
        return view('user.transaksi', compact('book'));
    }

    /**
     * Menyimpan transaksi dan pembayaran.
     */
    public function store(Request $request, $id)
{
    $book = Book::findOrFail($id);
    $biayaAdmin = 2000; // Biaya admin tetap
    $totalHarga = $book->harga + $biayaAdmin;

    // Membuat transaksi dengan status 'pending' terlebih dahulu
    $transaksi = Transaksi::create([
        'user_id' => Auth::id(),
        'buku_id' => $book->id,
        'total_harga' => $totalHarga,
        'status' => 'pending',  // Status awal transaksi adalah pending
        'metode_pembayaran' => $request->metode_pembayaran,  // Pastikan data pembayaran ada di form
    ]);

    // Simulasi proses pembayaran, jika pembayaran berhasil
    if ($request->has('payment_success') && $request->payment_success) {
        // Mengubah status transaksi menjadi 'success' jika pembayaran berhasil
        $transaksi->update(['status' => 'success']);

        // Arahkan ke halaman detail buku
        return redirect()->route('books.show', $book->id)
            ->with('success', 'Transaksi berhasil dan pembayaran diterima!');
    }

    // Jika transaksi masih dalam status 'pending', arahkan ke halaman transaksi
    return redirect()->route('user.transaksishow', $transaksi->id)
        ->with('success', 'Transaksi berhasil dibuat! Silakan lakukan pembayaran.');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
