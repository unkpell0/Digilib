<div class="book-detail max-w-screen-md mx-auto p-4">
    <img src="{{ $books->image_cover ? asset('storage/' . $books->image_cover) : asset('img/default-book.jpg') }}" alt="{{ $books->nama_buku }}" class="w-full h-64 object-cover">
    <h1 class="text-2xl font-bold mt-4">{{ $books->nama_buku }}</h1>
    <p class="text-gray-700 mt-2">{{ $books->deskripsi }}</p>
    <p class="text-gray-900 font-semibold mt-2">Penulis: {{ $books->penulis }}</p>
    <p class="text-gray-900 font-semibold mt-2">Harga: Rp{{ number_format($books->harga, 0, ',', '.') }}</p>
</div>
