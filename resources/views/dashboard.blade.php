<x-app-layout>
    <div class="relative bg-cover bg-center py-4 px-6" style="background-image: url('{{ asset('img/bgutama.jpeg') }}');">
        <div class="container mx-auto">
            <div class="flex items-center justify-evenly"> <!-- Ubah ke flex dan tambah items-center -->
                <!-- Kolom Teks -->
                <div class="flex-1 text-white"> <!-- Gunakan flex-1 daripada w-2/3 -->
                    <h1 class="text-4xl font-bold font-sans">
                        You <span class="text-red-500 text-5xl">DEFINE</span> your own life
                    </h1>
                </div>
    
                <!-- Kolom Gambar -->
                <div class="flex-shrink-0"> <!-- Gunakan flex-shrink-0 daripada w-1/3 -->
                    <div class="group hover:scale-95 transition-transform duration-500 rounded-lg">
                        <div style="background-image: url('{{ asset('img/imghome.jpeg') }}');"
                            class="w-32 h-32 md:w-40 md:h-40 rounded-lg bg-cover bg-center transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-6 shadow-lg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="w-full mx-auto bg-white shadow-md p-6 border-l-4 border-white">
        <!-- Form Pencarian -->
        <form action="{{ route('search') }}" method="GET" enctype="multipart/form-data">
            <div class="flex justify-end mb-6">
                <div class="flex items-center max-w-lg space-x-3 bg-gray-100 py-2 px-4 rounded-full shadow-md">
                    <input type="search" name="search" placeholder="Cari buku, genre, atau penulis..."
                        class="w-[14.3rem] flex-grow bg-transparent focus:outline-none text-gray-800 text-sm placeholder-gray-400 rounded-full pr-4"
                        value="{{ request('search') }}">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full shadow-md focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-all duration-200">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="flex justify-center mb-4">
            <h1 class="text-2xl font-bold">Recommended</h1>
        </div>

        <!-- Buttons -->
        <div class="flex justify-center space-x-2 mb-6">
            <a
                href="{{ request('kategori') === 'manga' ? route('dashboard') : route('dashboard', ['kategori' => 'manga']) }}">
                <button
                    class="px-6 py-2 rounded-full transition duration-300 
            {{ request('kategori') === 'manga' ? 'bg-emerald-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-emerald-500 hover:text-white focus:bg-emerald-500 focus:text-white' }}">
                    Manga
                </button>
            </a>
            <a
                href="{{ request('kategori') === 'novel' ? route('dashboard') : route('dashboard', ['kategori' => 'novel']) }}">
                <button
                    class="px-6 py-2 rounded-full transition duration-300 
            {{ request('kategori') === 'novel' ? 'bg-sky-400 text-white' : 'bg-gray-200 text-gray-700 hover:bg-sky-400 hover:text-white focus:bg-sky-400 focus:text-white' }}">
                    Novel
                </button>
            </a>
            <a
                href="{{ request('kategori') === 'manhwa' ? route('dashboard') : route('dashboard', ['kategori' => 'manhwa']) }}">
                <button
                    class="px-6 py-2 rounded-full transition duration-300 
            {{ request('kategori') === 'manhwa' ? 'bg-red-700 text-white' : 'bg-gray-200 text-gray-700 hover:bg-red-700 hover:text-white focus:bg-red-700 focus:text-white' }}">
                    Manhwa
                </button>
            </a>
        </div>



        </form>

        <!-- Carousel -->
        <div x-data="{ currentIndex: 0 }" class="relative w-full max-w-screen-lg mx-auto">
            <!-- Navigation -->
            <button @click="currentIndex = Math.max(currentIndex - 1, 0)"
                class="absolute -left-16 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white px-3 py-2 rounded-full shadow hover:bg-gray-600 z-10">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button @click="currentIndex = Math.min(currentIndex + 1, Math.ceil({{ $books->count() }} / 5) - 1)"
                class="absolute -right-16 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white px-3 py-2 rounded-full shadow hover:bg-gray-600 z-10">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <!-- Items -->
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500"
                    :style="'transform: translateX(-' + (currentIndex * 100) + '%)'">
                    @foreach ($books->chunk(5) as $chunk)
                        <div class="flex space-x-4 min-w-full">
                            @foreach ($chunk as $book)
                                @auth
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
                                @else
                                    <a href="javascript:void(0)" onclick="showAuthModal()" class="block w-1/5">
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
                                @endauth
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="authModal"
                class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-80">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Anda belum login</h2>
                    <p class="text-gray-700 mb-6">Silakan login atau register untuk melihat detail buku.</p>
                    <div class="flex justify-end space-x-4">
                        <button onclick="closeAuthModal()"
                            class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Tutup</button>
                        <button onclick="window.location.href='{{ route('login') }}'"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Login
                        </button>
                    </div>
                </div>
            </div>

            
        </div>
        <div class=" my-4 border-2 h-64 bg-red-300"></div>
    </div>

    <script>
        function showAuthModal() {
            document.getElementById('authModal').classList.remove('hidden');
        }

        function closeAuthModal() {
            document.getElementById('authModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
