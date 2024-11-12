<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">{{ $genre->nama_genre }}</h1>
        <div class="bg-white p-6 rounded shadow-md">
            <p class="text-gray-700 mb-4"><span class="font-semibold">Deskripsi:</span> {{ $genre->deskripsi }}</p>
            <p class="text-gray-700 mb-4"><span class="font-semibold">Slug:</span> {{ $genre->slug }}</p>
            <p class="text-gray-700"><span class="font-semibold">Views:</span> {{ $genre->views }}</p>
        </div>
        
    
        <div class="mt-6">
            <a href="{{ route('genre.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Kembali ke Daftar Genre
            </a>
        </div>
    </div>
</x-admin-layout>
