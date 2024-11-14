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
            <a href="{{ route('dashboard.index', ['kategori' => 'manga']) }}">
                <button
                    class="px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-emerald-500 hover:text-white focus:bg-emerald-500 focus:text-white">
                    Manga
                </button>
            </a>
    
            <!-- Novel Button -->
            <a href="{{ route('dashboard.index', ['kategori' => 'novel']) }}">
                <button
                    class="ml-2 px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-sky-400 hover:text-white focus:bg-sky-400 focus:text-white">
                    Novel
                </button>
            </a>
        </div>

        <!-- Daftar Buku -->
        <h2 class="text-xl font-bold mb-6 text-center">Search Results</h2>

        <div class="grid grid-cols-4 gap-4 mx-auto w-full max-w-screen-lg">
            @foreach($books as $book)
                <a href="#" class="block w-full">
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
