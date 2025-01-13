<x-app-layout>
    <div class="min-w-full overflow-x-hidden mx-auto">
        <div
            class="container bg-gradient-to-br from-sky-500 to-transparent border-2 rounded-xl px-4 py-3 mx-2 w-auto p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold">
                    Daftar Buku
                </h1>
            </div>
            {{-- tombol --}}
            <div class="flex justify-between items-center mb-4">
                <div class="flex space-x-2">
                    {{-- genre --}}
                    <button class="bg-slate-300 text-slate-700 font-bold text-base px-4 py-2 rounded">
                        Genre
                        <i class="fas fa-caret-down">
                        </i>
                    </button>
                    {{-- status --}}
                    <button class="bg-slate-300 text-slate-700 font-bold text-base px-4 py-2 rounded">
                        Status
                        <i class="fas fa-caret-down">
                        </i>
                    </button>
                    {{-- type --}}
                    <button class="bg-slate-300 text-slate-700 font-bold text-base px-3 py-2 rounded">
                        Type
                        <i class="fas fa-caret-down">
                        </i>
                    </button>
                    {{-- sort by --}}
                    <button class="bg-slate-300 text-slate-700 font-bold text-base px-3 py-1 rounded">
                        Sort By
                        <i class="fas fa-caret-down">
                        </i>
                    </button>
                    {{-- filter --}}
                    <button class="bg-slate-300 text-slate-700 font-bold text-lg px-4 py-2 rounded">
                        <i class="fa-solid fa-filter"></i>
                        Filter
                    </button>
                </div>
                <div>
                    <input class="bg-slate-300 text-slate-700 font-bold text-lg px-4 py-2 rounded" placeholder="Cari"
                        type="text" />
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($books as $book)
                    <!-- Manga Item -->
                    <div class="bg-slate-300 p-2 rounded">
                        <!-- Book Cover -->
                        <img alt="{{ $book->nama_buku }}" class="w-full h-48 object-cover rounded border-2 border-slate-900" height="300"
                            src="{{ $book->image_cover ? asset('storage/' . $book->image_cover) : asset('img/default-book.jpg') }}"
                            width="200" />

                        <!-- Genre and Flag -->
                        <div class="flex justify-between items-center mt-2">
                            <span class="bg-red-600 text-slate-700 font-bold px-2 py-1 text-xs rounded">
                                {{ strtoupper($book->penulis) }}
                            </span>
                            {{-- <img alt="Flag" class="w-5 h-5" height="20"
                                src="{{ $book->flag_url ? $book->flag_url : asset('img/default-flag.png') }}"
                                width="20" /> --}}
                        </div>

                        {{-- <!-- nama_buku -->
                        <h2 class="mt-2 text-sm">
                            {{ Str::limit($book->nama_buku, 20, '...') }}
                        </h2> --}}

                        <!-- Chapter -->
                        <p class="text-xs mt-2 text-gray-400">
                            {{ $book->deskripsi }}
                        </p>

                        <!-- Rating -->
                        <div class="flex items-center mt-2">
                            @php
                                // Calculate star ratings
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

                        {{-- harga --}}
                        <p class="text-xs mt-2 text-gray-400">
                          {{ $book->harga }}
                      </p>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
