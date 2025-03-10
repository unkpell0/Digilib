<x-app-layout>
    <div class="max-w-[1200px] mx-auto p-4">
        <!-- Navigation Back -->
        <x-back_button class="mb-2" />
         

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
                    <a href="{{ route('ratekoment', ['id' => $book->id]) }}"
                        class="mt-4 inline-block w-full px-4 py-2.5 text-center bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-star mr-1"></i>Reviews ({{ $komentview }})
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
                    <div class="space-y-3">
                        @if ($hasPurchased)
                            @if ($book->file_buku)
                                <!-- Tombol Download -->
                                <a href="{{ asset('storage/' . $book->file_buku) }}" download="{{ $book->nama_buku }}"
                                    class="inline-block w-full px-4 py-2.5 bg-blue-600 text-white text-center text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    <i class="fas fa-download mr-1"></i>Unduh Buku
                                </a>
                            @else
                                <span
                                    class="block w-full px-4 py-2.5 bg-gray-400 text-white text-center text-sm font-medium rounded-lg">
                                    File tidak tersedia
                                </span>
                            @endif
                        @else
                            <!-- Bagian tombol Checkout dan Tambah ke Keranjang -->
                            <div class="flex flex-col sm:flex-row gap-3">
                                <!-- Tombol Checkout -->
                                <a href="{{ route('transaksi.create', $book->id) }}"
                                    class="flex-1 inline-flex items-center justify-center 
              px-5 py-3 
              bg-gradient-to-r from-green-500 to-lime-500 
              text-white font-semibold text-sm 
              rounded-full shadow-md
              hover:from-green-600 hover:to-lime-600 
              transition-colors duration-300 
              focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Check Out!
                                </a>

                                <!-- Tombol Tambah ke Keranjang -->
                                <form action="{{ route('cart.store') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center 
                       px-5 py-2 
                       bg-gradient-to-r from-teal-500 to-emerald-500 
                       text-white font-semibold text-sm 
                       rounded-full shadow-md
                       hover:from-teal-600 hover:to-emerald-600
                       transition-colors duration-300 
                       focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                                        <i class="fas fa-cart-plus mr-2"></i>
                                        Tambah ke Keranjang
                                    </button>
                                </form>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
