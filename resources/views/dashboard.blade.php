<x-app-layout>
    <div class="bg-white p-8 my-1 shadow-sm flex justify-around items-center">
        <h1 class="text-2xl font-semibold font-sans">You <span class="text-red-500 text-4xl">DEFINE</span> your own life
        </h1>
        <div class="group hover:scale-95 transition-transform duration-500 rounded-lg">
            <div style="background-image: url('{{ asset('img/imghome.jpeg') }}');"
                class="w-36 h-36 rounded-lg bg-cover bg-center transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-6">
            </div>
        </div>
    </div>

    <div class="w-full mx-auto bg-white shadow-md p-6 border-l-4 border-white">
        <!-- Form Pencarian -->
        <form action="{{ route('search') }}" method="GET" enctype="multipart/form-data">
            <div class="flex justify-end mb-6">
                <div class="flex items-center max-w-lg space-x-3 bg-gray-100 py-2 px-4 rounded-full shadow-md">
                    <input type="search" name="search" placeholder="Cari buku, genre, atau penulis..."
                        class="flex-grow bg-transparent focus:outline-none text-gray-800 text-sm placeholder-gray-400 rounded-full pr-4"
                        value="{{ request('search') }}">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full shadow-md focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-all duration-200">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Buttons -->
        <div class="flex justify-center space-x-2 mb-6">
            <a href="{{ route('home', ['kategori' => 'manga']) }}">
                <button
                    class="px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-emerald-500 hover:text-white focus:bg-emerald-500 focus:text-white">
                    Manga
                </button>
            </a>
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
    </form>

    <!-- Buttons -->
    <div class="flex justify-center space-x-2 mb-6">
        <a href="{{ route('dashboard.index', ['kategori' => 'manga']) }}">
            <button class="px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-emerald-500 hover:text-white focus:bg-emerald-500 focus:text-white">
                Manga
            </button>
        </a>
        <a href="{{ route('dashboard.index', ['kategori' => 'novel']) }}">
            <button class="ml-2 px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-sky-400 hover:text-white focus:bg-sky-400 focus:text-white">
                Novel
            </button>
        </a>
        <a href="{{ route('dashboard.index', ['kategori' => 'manhwa']) }}">
            <button class="ml-2 px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-red-700 hover:text-white focus:bg-red-700 focus:text-white">
                Manhwa
            </button>
        </a>
    </div>

        <!-- Carousel -->
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
    </div>

</x-app-layout>
