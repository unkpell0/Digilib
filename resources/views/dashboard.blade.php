<x-app-layout>
    <div class="relative bg-cover bg-center">
                <!-- Kolom Gambar -->
                <div x-data="{
                    currentSlide: 0,
                    slides: [{
                            image: '{{ asset('img/bgutama.jpeg') }}',
                            title: 'Slide 1',
                            description: 'Deskripsi atau teks tambahan untuk slide pertama',
                            link: '#'
                        },
                        {
                            image: '{{ asset('img/imghome.jpeg') }}',
                            title: 'Slide 2',
                            description: 'Deskripsi slide kedua, bisa untuk promo atau link buku terbaru',
                            link: '#'
                        },
                        {
                            image: '{{ asset('img/maestro.jpg') }}',
                            title: 'Slide 3',
                            description: 'Deskripsi slide ketiga',
                            link: '#'
                        },
                        // Tambahkan slide lain sesuai kebutuhan
                    ],
                    init() {
                        if (! this.intervalSet) {
                            this.interval = setInterval(() => this.nextSlide(), 5000)
                            this.intervalSet = true
                        }
                    },
                    nextSlide() {
                        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                    },
                    prevSlide() {
                        // Menangani slide mundur, supaya tidak error saat di index 0
                        this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                    }
                }" x-init="init()"
                    class="relative w-full h-[300px] md:h-[400px] overflow-hidden">
                    <!-- Wrapper untuk semua slide -->
                    <template x-for="(slide, index) in slides" :key="index">
                        <!-- Setiap slide -->
                        <div class="absolute inset-0 bg-center bg-cover flex items-center justify-center transition-opacity duration-700"
                            x-show="currentSlide === index"                            
                            <!-- Overlay Gelap agar teks lebih jelas (opsional) -->
                            <div class="bg-black bg-opacity-5  w-full h-full flex items-center justify-center">
                                <div class="text-center text-white px-4 max-w-xl">
                                    <h2 class="text-2xl md:text-4xl font-bold mb-2" x-text="slide.title"></h2>
                                    <p class="text-sm md:text-base mb-4" x-text="slide.description"></p>
                                    <a :href="slide.link"
                                        class="inline-block bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-full text-white text-sm md:text-base">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Tombol Prev -->
                    <button @click="prevSlide()"
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-700 bg-opacity-50 text-white p-2 rounded-full hover:bg-gray-600 focus:outline-none">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>

                    <!-- Tombol Next -->
                    <button @click="nextSlide()"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-700 bg-opacity-50 text-white p-2 rounded-full hover:bg-gray-600 focus:outline-none">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
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
                                                {{ number_format($book->averageRating, 1) }} dari
                                                {{ $book->totalRaters }} ratings
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="authModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
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
        <div class=" my-4 h-64 bg-white"></div>
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
