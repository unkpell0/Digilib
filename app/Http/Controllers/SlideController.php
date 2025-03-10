<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua slide untuk ditampilkan di halaman Pengaturan Umum
        $slides = Slide::all();
        return view('admin.umum', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Jika form pembuatan slide sudah ada di view 'admin.umum',
        // method ini bisa dikosongkan atau redirect ke halaman umum.
        return view('admin.umum');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'slide_image' => 'required|image',
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Tangani upload file
        if ($request->hasFile('slide_image')) {
            $file = $request->file('slide_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Simpan file di direktori 'public/slides'
            $file->storeAs('public/slides', $filename);
        } else {
            return redirect()->back()->withErrors('File gambar tidak ditemukan.');
        }

        // Buat record slide baru
        Slide::create([
            'image'       => $filename,
            'title'       => $validated['title'] ?? '',
            'description' => $validated['description'] ?? '',
        ]);

        return redirect()->back()->with('success', 'Slide berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
