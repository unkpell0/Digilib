<x-app-layout>
    <div class="bg-white p-8 my-4 rounded-md shadow-sm flex justify-around items-center">
        <h1 class="text-2xl font-semibold font-sans">You <span class="text-red-500 text-4xl">DEFINE</span> your own life</h1>
        <img src="{{ asset('img/imghome.jpeg') }}" alt="" class="w-36">
    </div>

    <div class="w-full mx-auto bg-white shadow-md p-6 border-l-4 border-white">
        <!-- Form Pencarian -->
        <form action="{{ route('search') }}" method="GET" enctype="multipart/form-data">
            <div class="flex justify-end mb-6 p-2 rounded-full">
                <div class="flex items-center max-w-md space-x-2 bg-gray-200 py-2 px-3 rounded-full">
                    <input type="search" name="search" placeholder="Search" 
                        class="flex-grow p-2 bg-white-200 focus:outline-none rounded-full focus:ring-0"
                        value="{{ request('search') }}">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="flex justify-center space-x-2 mb-6">
            <!-- Manga Button -->
            <a href="{{ route('home', ['kategori' => 'manga']) }}">
                <button
                    class="px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-emerald-500 hover:text-white focus:bg-emerald-500 focus:text-white">
                    Manga
                </button>
            </a>
    
            <!-- Novel Button -->
            <a href="{{ route('home', ['kategori' => 'novel']) }}">
                <button
                    class="ml-2 px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-sky-400 hover:text-white focus:bg-sky-400 focus:text-white">
                    Novel
                </button>
            </a>

            <a href="{{ route('home', ['kategori' => 'manhwa']) }}">
                <button
                    class="ml-2 px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-red-700 hover:text-white focus:bg-red-700 focus:text-white">
                    Manhwa
                </button>
            </a>
        </div>

        <!-- Daftar Buku -->
        <h2 class="text-xl font-bold mb-6 text-center">Search Results</h2>

        <div x-data="{ currentIndex: 0 }" class="relative w-full max-w-screen-lg mx-auto">
            <!-- Navigation -->
            <button @click="currentIndex = Math.max(currentIndex - 1, 0)"
                class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white p-2 rounded-full shadow hover:bg-gray-600 z-10">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button @click="currentIndex = Math.min(currentIndex + 1, Math.ceil({{ $books->count() }} / 5) - 1)"
                class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white p-2 rounded-full shadow hover:bg-gray-600 z-10">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <!-- Items -->
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500"
                    :style="'transform: translateX(-' + (currentIndex * 100) + '%)'">
                    @foreach ($books->chunk(5) as $chunk)
                        <div class="flex space-x-4 min-w-full">
                            @foreach ($chunk as $book)
                                <a href="{{ route('buku.show', $book->id) }}" class="block w-1/5">
                                    <div class="bg-gray-100 p-2 rounded shadow-md hover:shadow-lg">
                                        <img src="{{ $book->image_cover ? asset('storage/' . $book->image_cover) : asset('img/default-book.jpg') }}"
                                            alt="{{ $book->nama_buku }}"
                                            class="w-full h-48 object-cover rounded border border-black">
                                        <div class="flex justify-between items-center mt-2">
                                            <span class="bg-red-600 text-white font-bold px-2 py-1 text-xs rounded">
                                                {{ strtoupper($book->penulis) }}
                                            </span>
                                        </div>
                                        <div class="p-2 font-bold text-xl text-slate-900 text-center">
                                            {{ Str::limit($book->nama_buku, 15, '...') }}
                                        </div>
                                        
                                        <p class="text-xs mt-1 font-medium text-black line-clamp-2">
                                            {{ $book->deskripsi }}
                                        </p>
                                        <!-- Rating -->
                                        <div class="flex items-center font-medium mt-2">
                                            @if ($book->totalRaters > 0)
                                                <div class="flex items-center space-x-2">
                                                    <p class="font-bold text-gray-700 text-sm">{{ round($book->averageRating, 1) }}</p>
                                                    <div class="flex space-x-0.5">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                                @if ($i <= round($book->averageRating))
                                                                    <path d="M10 15.27L16.18 19l-1.64-7.03L19 7.24l-7.19-.61L10 0 8.19 6.63 1 7.24l5.46 4.73L4.82 19z"/>
                                                                @else
                                                                    <path d="M10 15.27L16.18 19l-1.64-7.03L19 7.24l-7.19-.61L10 0 8.19 6.63 1 7.24l5.46 4.73L4.82 19z" class="text-gray-300"/>
                                                                @endif
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                </div>
                                            @else
                                                <p class="text-gray-700 text-sm">Belum ada rating.</p>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
