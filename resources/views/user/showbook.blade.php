<x-app-layout>
    <div class="max-w-[1200px] mx-auto p-4">
        <!-- Navigation Back -->
        <a href="/home"
            class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4 text-sm transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10.707 3.293a1 1 0 0 1 0 1.414L6.414 9H17a1 1 0 1 1 0 2H6.414l4.293 4.293a1 1 0 0 1-1.414 1.414l-6-6a1 1 0 0 1 0-1.414l6-6a1 1 0 0 1 1.414 0z"
                    clip-rule="evenodd" />
            </svg>
            Kembali
        </a>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Book Info Section -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-4">
                    <img src="{{ asset('storage/' . $book->image_cover) }}" alt="{{ $book->nama_buku }}"
                        class="w-full max-h-80 object-cover rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">

                    <h1 class="text-xl font-bold text-gray-800 mt-4">{{ $book->nama_buku }}</h1>

                    <!-- Rating Section -->
                    <div class="mt-3">
                        <p class="font-semibold text-gray-700 text-sm">Rating:</p>
                        @if ($totalRaters > 0)
                            <div class="flex items-center gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15.27L16.18 19l-1.64-7.03L19 7.24l-7.19-.61L10 0 8.19 6.63 1 7.24l5.46 4.73L4.82 19z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-xs text-gray-600">
                                {{ round($averageRating, 1) }} dari {{ $totalRaters }} perating
                            </p>
                        @else
                            <p class="text-xs text-gray-600">Belum ada rating.</p>
                        @endif
                    </div>

                    <!-- Book Details -->
                    <div class="mt-3 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Penulis</span>
                            <span class="font-medium">{{ $book->penulis }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Genre</span>
                            <span class="font-medium">{{ $book->genres->pluck('nama_genre')->join(', ') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Harga</span>
                            <span class="font-medium">Rp{{ number_format($book->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Reviews Button -->
                    <a href="{{ route('ratekoment', ['id' => $book->id]) }}" class="inline-block w-full mt-4">
                        <button
                            class="w-full px-4 py-2.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                            Reviews ({{ $komentview }})
                        </button>
                    </a>
                </div>
            </div>

            <!-- DESKRIPSI -->
            <div class="bg-white rounded-lg shadow-lg p-4 md:col-span-2">
                <h2 class="text-lg font-bold text-gray-800 mb-3">Deskripsi Buku</h2>
                <p class="text-gray-600 text-sm leading-normal">{{ $book->deskripsi }}</p>
            </div>

            <!-- Actions Section -->
            <div class="bg-white rounded-lg shadow-lg p-4 md:col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Rating & Comments -->
                    <div class="space-y-3">
                        <!-- Tombol -->
                        <div class="space-y-3">
                            @if ($hasPurchased)
                                @if ($book->file_buku)
                                    <a href="{{ asset('storage/' . $book->file_buku) }}"
                                        class="block w-full px-4 py-2.5 bg-blue-600 text-white text-center text-sm rounded-lg hover:bg-blue-700 transition-colors"
                                        download="{{ $book->nama_buku }}">
                                        <i class="fas fa-download mr-1"></i>Unduh Buku
                                    </a>
                                @else
                                    <span
                                        class="block w-full px-4 py-2.5 bg-gray-400 text-white text-center rounded-lg text-sm">
                                        File tidak tersedia
                                    </span>
                                @endif
                            @else
                                <div class="flex flex-row space-x-2">
                                    <a href="{{ route('transaksi.create', $book->id) }}"
                                        class="flex-1 px-4 py-2.5 bg-green-500 text-white text-center text-sm rounded-lg hover:bg-green-600 transition-colors">
                                        <i class="fas fa-shopping-cart mr-1"></i>Check Out!
                                    </a>
                            @endif

                            <form action="{{ route('cart.store') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit"
                                    class="w-full px-4 py-2.5 bg-green-500 text-white text-sm rounded-lg hover:bg-green-600 transition-colors">
                                    <i class="fas fa-cart-plus mr-1"></i>Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
