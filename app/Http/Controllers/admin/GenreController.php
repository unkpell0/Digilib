<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genre.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genre.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_genre' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'slug' => 'required|string|unique:genre,slug',
            'views' => 'nullable|integer',
        ]);

        Genre::create([
            'nama_genre' => $request->nama_genre,
            'deskripsi' => $request->deskripsi,
            'slug' => $request->slug,
            'views' => $request->views ?? 0, 
        ]);

        return redirect()->route('genre.index')->with('success', 'Genre berhasil ditambahkan.');
    }

    public function show($id)
    {
        $genre = Genre::findOrFail($id);
        return view('admin.genre.show', compact('genre'));
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('admin.genre.edit', compact('genre'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_genre' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'slug' => 'required|string|unique:genre,slug,' . $id,
            'views' => 'nullable|integer',
        ]);

        $genre = Genre::findOrFail($id);
        $genre->update($request->all());

        return redirect()->route('genre.index')->with('success', 'Genre berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('genres.index')->with('success', 'Genre berhasil dihapus.');
    }
}
