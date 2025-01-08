<x-app-layout>
    <main class="max-w-6xl mx-auto mt-6 grid grid-cols-3 gap-8">
        {{-- Info Buku --}}
        <section class="bg-white p-6 rounded-lg shadow-md">
            {{-- Gambar Cover Buku --}}
            <div class="text-center">
                <img src="{{ asset('storage/' . $book->image_cover) }}" alt="{{ $book->nama_buku }}"
                    class="w-3/4 h-auto mx-auto rounded-lg border-2 border-[#377CC7] shadow-lg">
            </div>

            {{-- Judul Buku --}}
            <div class="mt-4 text-left">
                <h1 class="text-xl font-semibold text-gray-800">{{ $book->nama_buku }}</h1>
            </div>

            {{-- Informasi Buku --}}
            <div class="mt-4 text-left">
                <p class="text-gray-700">
                    <strong>Author:</strong> {{ $book->penulis }}
                </p>
                <p class="text-gray-700 mt-1">
                    <strong>Genre:</strong> {{ $book->genres->pluck('nama_genre')->join(', ') }}
                </p>
                <p class="text-gray-700 mt-1">
                    <strong>Harga:</strong> Rp{{ number_format($book->harga, 0, ',', '.') }}
                </p>
            </div>

            {{-- Tombol Reviews --}}
            <div class="mt-4">
                <button class="px-4 py-2 bg-[#377CC7] text-white rounded-lg hover:bg-[#2d68a2] transition duration-300">
                    Reviews (200)
                </button>
            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-4">
                <a href="/dashboard" class="text-[#377CC7] hover:underline">&larr; Kembali</a>
            </div>
        </section>

        {{-- Deskripsi Buku --}}
        <section class="bg-white p-6 rounded-lg shadow-md col-span-2 h-auto">
            <h2 class="text-lg font-bold mb-4">Deskripsi Buku</h2>
            <p class="text-gray-700 leading-relaxed">
                {{ $book->deskripsi }}
            </p>
        </section>

        {{-- Metode Pembayaran dan Transaksi --}}
        <section class="bg-white p-6 rounded-lg shadow-md col-span-3">
            <div class="flex flex-col space-y-4">
                {{-- Button Checkout --}}
                <a href="{{ route('transaksi.create', $book->id) }}"
                    class="px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 flex items-center justify-center transition duration-300">
                    Check Out!
                </a>
                <form action="{{ route('cart.store') }}" method="POST" class="inline-block">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="quantity" value="1" min="1" class="border p-2">
                    <button type="submit"
                        class="px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 flex items-center justify-center transition duration-300">
                        Cart
                    </button>
                </form>
                
                
                {{-- Button Wishlist --}}
                <a href="#"
                    class="px-4 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 flex items-center justify-center transition duration-300">
                    Wishlist
                </a>

                {{-- Button Unduh Buku --}}
                @if ($hasPurchased)
                    @if ($book->file_buku)
                        <a href="{{ asset('storage/' . $book->file_buku) }}"
                            class="px-4 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 flex items-center justify-center transition duration-300"
                            download="{{ $book->nama_buku }}">
                            Unduh Buku
                        </a>
                    @else
                        <span class="px-4 py-3 bg-gray-400 text-white rounded-lg flex items-center justify-center">
                            File tidak tersedia
                        </span>
                    @endif
                @endif
            </div>
        </section>
    </main>
</x-app-layout>
