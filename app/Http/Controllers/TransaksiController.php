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
        return view('book.transaction', compact('transaksi','book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $buku = Book::findOrFail($id);
        $biaya_admin = 2000; // Biaya admin tetap
        $total_harga = $buku->harga + $biaya_admin;

        return view('user.transaksicreate', compact('buku', 'biaya_admin', 'total_harga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'buku_id' => 'required|exists:buku,id',
    ]);

    $buku = Book::findOrFail($validated['buku_id']);
    $biayaAdmin = 2000;
    $totalHarga = $buku->harga + $biayaAdmin;

    $transaksi = Transaksi::create([
        'user_id' => Auth::id(),
        'buku_id' => $buku->id,
        'total_harga' => $totalHarga,
        'status' => 'pending',
        'tanggal_transaksi' => null,
        'access_granted' => false,
    ]);

    return redirect()->route('transaksi.index', $buku->id)
        ->with('success', 'Transaksi berhasil dibuat!');
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
