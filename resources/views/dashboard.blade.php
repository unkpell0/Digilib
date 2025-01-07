<x-app-layout>
    <div class="bg-white p-8 my-1 shadow-sm flex justify-around items-center">
        <h1 class="text-2xl font-semibold font-sans">You <span class="text-red-500 text-4xl">DEFINE</span> your own life</h1>
        <div class="group hover:scale-95 transition-transform duration-500 rounded-lg">
            <div style="background-image: url('{{ asset('img/imghome.jpeg') }}');" class="w-36 h-36 rounded-lg bg-cover bg-center transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-6"></div>
        </div>
    </div>

    <div class="w-full mx-auto bg-white shadow-md p-6 border-l-4 border-white">
        <!-- Form Pencarian -->
        <form action="{{ route('search') }}" method="GET" enctype="multipart/form-data">
            <div class="flex justify-end mb-6">
                <div class="flex items-center max-w-lg space-x-3 bg-gray-100 py-2 px-4 rounded-full shadow-md">
                    <input type="search" name="search" placeholder="Cari buku, genre, atau penulis..." class="flex-grow bg-transparent focus:outline-none text-gray-800 text-sm placeholder-gray-400 rounded-full pr-4" value="{{ request('search') }}">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full shadow-md focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-all duration-200">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="flex justify-center space-x-2 mb-6">
            <!-- Manga Button -->
            <a href="{{ route('dashboard.index', ['kategori' => 'manga']) }}">
                <button class="px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-emerald-500 hover:text-white focus:bg-emerald-500 focus:text-white">
                    Manga
                </button>
            </a>

            <!-- Novel Button -->
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

        <!-- Title -->
        <h2 class="text-xl font-bold mb-6 text-center">Baru Rilis !!</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-auto w-full max-w-screen-lg">
            @foreach($books as $book)
                <a href="{{ route('buku.show', $book->id) }}" class="block w-full">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden w-full">
                        <img src="{{ $book->image_cover ? asset('storage/' . $book->image_cover) : asset('img/default-book.jpg') }}" alt="{{ $book->nama_buku }}" class="w-full h-64 object-cover">
                        <div class="p-2 bg-blue-500 text-white text-center">
                            {{ $book->nama_buku }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
