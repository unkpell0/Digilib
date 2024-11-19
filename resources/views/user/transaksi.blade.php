<x-app-layout>
    <main class="max-w-4xl mx-auto mt-10">
        {{-- Header --}}
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Detail Transaksi</h1>
        </div>

        {{-- Konten Utama --}}
        <div class="mt-6 grid grid-cols-3 gap-6">
            {{-- Informasi Buku --}}
            <section class="bg-gray-100 p-6 rounded-lg shadow-md">
                {{-- Cover Buku --}}
                <div class="flex justify-center">
                    <img src="{{ asset('storage/' . $book->image_cover) }}" alt="{{ $book->nama_buku }}">
                </div>
                {{-- Judul Buku --}}
                <h2 class="mt-4 text-lg font-semibold text-gray-800">{{ $book->nama_buku }}</h2>
                {{-- Informasi Tambahan --}}
                <p class="mt-2 text-gray-700">
                    <strong>Karya:</strong> {{ $book->penulis }}
                </p>
                <p class="mt-1 text-gray-700">
                    <strong>Genre:</strong> {{ $book->genres->pluck('nama_genre')->join(', ') }}
                </p>
                <p class="mt-1 text-gray-700">
                    <strong>Harga:</strong> Rp{{ number_format($book->harga, 0, ',', '.') }}
                </p>
                {{-- Tombol Kembali --}}
                <a href="/dashboard" class="mt-4 inline-block text-blue-500 hover:underline">&larr; Kembali</a>
            </section>

            {{-- Detail Transaksi --}}
            <section class="col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-800">Detail Transaksi</h2>
                <div class="mt-4">
                    <p class="text-gray-700">
                        <strong>Judul:</strong> {{ $book->nama_buku }}
                    </p>
                    <p class="mt-1 text-gray-700">
                        <strong>Karya:</strong> {{ $book->penulis }}
                    </p>
                    <p class="mt-1 text-gray-700">
                        <strong>Harga:</strong> Rp{{ number_format($book->harga - 2000, 0, ',', '.') }}
                    </p>
                    <p class="mt-1 text-gray-700">
                        <strong>Biaya Layanan:</strong> Rp1.000
                    </p>
                    <p class="mt-1 text-gray-700">
                        <strong>Biaya Jasa Aplikasi:</strong> Rp1.000
                    </p>
                    <hr class="my-4 border-gray-300">
                    <p class="text-lg font-semibold text-gray-800">
                        <strong>Total Tagihan:</strong> Rp{{ number_format($book->harga, 0, ',', '.') }}
                    </p>
                </div>
                {{-- Tombol Lihat Buku --}}
                @if ($book->status_pembelian === 'selesai')
                    <a href="/books/{{ $book->id }}"
                        class="mt-6 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        See Book
                    </a>
                @else
                    <button disabled
                        class="mt-6 inline-block px-4 py-2 bg-gray-400 text-white rounded cursor-not-allowed">
                        See Book
                    </button>
                @endif
                <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    Check Out
                </button>
            </section>
        </div>
    </main>
</x-app-layout>
