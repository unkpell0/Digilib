<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.kategori.add');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::create($validatedData);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified category and increment visit count.
     */
    public function show(Kategori $kategori)
    {
        $kategoris = Kategori::all();
        

        return view('admin.kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $Kategoris = Kategori::findOrFail($id);
        $Kategoris->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
