<x-app-layout>
    <div class="min-w-full overflow-hidden mx-auto px-4 py-6 bg-gray-50">
        <div class="container mx-auto">
            <!-- Header Section with Gradient -->
            <div class="relative mb-8 rounded-xl overflow-hidden">
                <!-- Background with subtle pattern overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-sky-400 to-sky-400 opacity-90"></div>
                <div
                    class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMwLTkuOTQtOC4wNi0xOC0xOC0xOHY2YzYuNjI3IDAgMTIgNS4zNzMgMTIgMTJoNnptLTYgNmMwLTYuNjI3LTUuMzczLTEyLTEyLTEydjZjMy4zMTQgMCA2IDIuNjg2IDYgNmg2eiIgZmlsbD0iI2ZmZiIvPjwvZz48L3N2Zz4=')]">
                </div>

                <!-- Content -->
                <div class="relative py-12 px-8 text-white">
                    <h1 class="text-4xl font-bold mb-2">Digilib</h1>
                    <p class="text-lg max-w-2xl opacity-90">Temukan koleksi buku digital terlengkap untuk menambah
                        wawasan dan inspirasi Anda</p>

                    <!-- Search Box (Large & Centered) -->
                    <div class="mt-8 max-w-2xl">
                        <form action="{{ route('searchExplore') }}" method="GET">
                            <div class="relative">
                                <input type="text" name="search"
                                    placeholder="Cari judul buku, penulis atau genre..."
                                    class="w-full px-6 py-4 rounded-full text-gray-800 shadow-lg focus:outline-none focus:ring-2 focus:ring-sky-400 text-lg" />
                                <button type="submit"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-sky-400 hover:bg-sky-500 text-white p-3 rounded-full shadow-md transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="mb-8">
                <div class="flex flex-wrap items-center gap-3">
                    <!-- Dropdown Genre Sederhana dengan Relasi Database -->
                    <div class="relative" x-data="{ open: false }">
                        <!-- Tombol Dropdown -->
                        <button @click="open = !open"
                            class="flex items-center gap-2 bg-white border border-gray-300 text-gray-700 px-3 py-2 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                            </svg>
                            <span>Genre</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Isi Dropdown -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute z-10 mt-1 w-48 bg-white shadow-lg rounded-md py-1">
                            @foreach ($genres as $genre)
                                <a href="{{ route('books.by.genre', $genre->nama_genre) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ $genre->nama_genre }}
                                    @if ($genre->views > 0)
                                        <span class="ml-1 text-xs text-sky-500">
                                            ({{ number_format($genre->views >= 1000 ? $genre->views / 1000 : $genre->views, $genre->views >= 1000 ? 1 : 0) }}{{ $genre->views >= 1000 ? 'k' : '' }}
                                            views)
                                        </span>
                                    @endif

                                </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- Status Dropdown -->
                    <div class="relative">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium px-4 py-2.5 rounded-lg transition duration-200 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Status
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="py-2 px-3 w-48">
                                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Status
                                        Buku</h3>
                                    <x-dropdown-link
                                        href="{{ route('explore', ['status' => 'available']) }}">Tersedia</x-dropdown-link>
                                    <x-dropdown-link href="{{ route('explore', ['status' => 'best-seller']) }}">Best
                                        Seller</x-dropdown-link>
                                    <x-dropdown-link
                                        href="{{ route('explore', ['status' => 'new']) }}">Baru</x-dropdown-link>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Type Dropdown -->
                    <div class="relative">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium px-4 py-2.5 rounded-lg transition duration-200 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                        <path fill-rule="evenodd"
                                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Kategori
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="py-2 px-3 w-48">
                                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tipe
                                        Buku</h3>
                                    <x-dropdown-link
                                        href="{{ route('explore', ['type' => 'ebook']) }}">E-Book</x-dropdown-link>
                                    <x-dropdown-link
                                        href="{{ route('explore', ['type' => 'printed']) }}">Cetak</x-dropdown-link>
                                    <x-dropdown-link href="{{ route('explore', ['type' => 'audiobook']) }}">Audio
                                        Book</x-dropdown-link>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Sort Dropdown -->
                    <div class="relative">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center gap-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium px-4 py-2.5 rounded-lg transition duration-200 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                                    </svg>
                                    Urutkan
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="py-2 px-3 w-48">
                                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                        Urutkan Berdasarkan</h3>
                                    <x-dropdown-link
                                        href="{{ route('explore', ['sort_by' => 'newest']) }}">Terbaru</x-dropdown-link>
                                    <x-dropdown-link href="{{ route('explore', ['sort_by' => 'rating']) }}">Rating
                                        Tertinggi</x-dropdown-link>
                                    <x-dropdown-link
                                        href="{{ route('explore', ['sort_by' => 'popular']) }}">Popularitas</x-dropdown-link>
                                    <x-dropdown-link href="{{ route('explore', ['sort_by' => 'price_low']) }}">Harga:
                                        Rendah ke Tinggi</x-dropdown-link>
                                    <x-dropdown-link href="{{ route('explore', ['sort_by' => 'price_high']) }}">Harga:
                                        Tinggi ke Rendah</x-dropdown-link>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Filter button - For mobile or as a reset -->
                    <a href="{{ route('explore') }}"
                        class="flex items-center gap-2 bg-sky-400 hover:bg-sky-600 text-white font-medium px-4 py-2.5 rounded-lg transition duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                clip-rule="evenodd" />
                        </svg>
                        Reset Filter
                    </a>
                </div>
            </div>

            <!-- Active Filters (Optional) -->
            @if (request()->has('genre') || request()->has('status') || request()->has('type') || request()->has('sort_by'))
                <div class="flex flex-wrap items-center gap-2 mb-6">
                    <span class="text-sm text-gray-500">Filter Aktif:</span>

                    @if (request()->has('genre'))
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-sky-100 text-sky-800">
                            Genre: {{ ucfirst(request()->genre) }}
                            <a href="{{ route('explore', array_merge(request()->except('genre'), [])) }}"
                                class="ml-1.5 text-sky-600 hover:text-sky-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </span>
                    @endif

                    <!-- Similar blocks for status, type, and sort_by -->
                </div>
            @endif

            <!-- Book Grid with Improved Cards -->
            <div
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 max-h-screen overflow-y-auto pb-8">
                @if ($books->count() > 0)
                    @foreach ($books as $book)
                        <a href="{{ route('buku.show', $book->id) }}" class="group">
                            <div
                                class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 h-full flex flex-col transform hover:-translate-y-1">
                                <!-- Cover Image with Gradient Overlay -->
                                <div class="relative aspect-[2/3] overflow-hidden">
                                    <img alt="{{ $book->nama_buku }}"
                                        class="w-full h-full object-cover transition duration-300 group-hover:scale-105"
                                        src="{{ $book->image_cover ? asset('storage/' . $book->image_cover) : asset('img/default-book.jpg') }}" />

                                    <!-- Gradient Overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>

                                    <!-- Quick View Button (shows on hover) -->
                                    <div
                                        class="absolute bottom-3 left-0 right-0 flex justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <span
                                            class="bg-white/90 text-gray-800 px-3 py-1.5 rounded-full text-xs font-medium shadow-lg">
                                            Lihat Detail
                                        </span>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-4 flex-grow flex flex-col">
                                    <!-- Genre Tags -->
                                    <div class="flex flex-wrap gap-1 mb-2">
                                        @foreach ($book->genres as $genre)
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full
                                                @if ($genre->nama_genre == 'Romance') bg-red-100 text-red-700
                                                @elseif($genre->nama_genre == 'Fantasy') bg-purple-100 text-purple-700
                                                @elseif($genre->nama_genre == 'Action') bg-blue-100 text-blue-700
                                                @else bg-gray-100 text-gray-700 @endif">
                                                {{ $genre->nama_genre }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <!-- Book Title -->
                                    <h2
                                        class="font-bold text-gray-800 group-hover:text-sky-400 transition-colors duration-200 mb-1 leading-tight line-clamp-2">
                                        {{ $book->nama_buku }}
                                    </h2>

                                    <!-- Description -->
                                    <p class="text-xs text-gray-500 mb-2 line-clamp-2">{{ $book->deskripsi }}</p>

                                    <!-- Rating -->
                                    <div class="flex items-center gap-1 mt-2">
                                        @php
                                            $roundedRating = round($book->averageRating);
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $roundedRating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M10 15.27L16.18 19l-1.64-7.03L19 7.24l-7.19-.61L10 0 8.19 6.63 1 7.24l5.46 4.73L4.82 19z" />
                                            </svg>
                                        @endfor
                                        <span class="ml-2 text-xs text-gray-600">
                                            {{ number_format($book->averageRating, 1) }} dari {{ $book->totalRaters }}
                                            perating
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="col-span-full py-16 flex flex-col items-center justify-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-600 mb-2">Buku Tidak Ditemukan</h3>
                        <p class="text-gray-500 max-w-md mb-6">Maaf, tidak ada buku yang sesuai dengan kriteria
                            pencarian Anda. Coba dengan kata kunci atau filter yang berbeda.</p>
                        <a href="{{ route('explore') }}"
                            class="flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Kembali ke Semua Buku
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
