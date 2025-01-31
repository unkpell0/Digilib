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
                                        @php
                                            // Perhitungan bintang rating
                                            $fullStars = floor($book->rating);
                                            $halfStar = $book->rating - $fullStars >= 0.5;
                                        @endphp
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $fullStars)
                                                <i class="fas fa-star text-yellow-500"></i>
                                            @elseif ($i === $fullStars && $halfStar)
                                                <i class="fas fa-star-half-alt text-yellow-500"></i>
                                            @else
                                                <i class="far fa-star text-yellow-500"></i>
                                            @endif
                                        @endfor
                                        <span class="ml-2 text-xs">
                                            {{ number_format($book->rating, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
