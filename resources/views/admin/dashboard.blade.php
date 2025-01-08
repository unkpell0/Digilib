<x-admin-layout>
    {{-- container --}}
    <div class="flex min-h-dvh w-full bg-gray-100">
        <!-- Sidebar -->
        {{-- <x-sidebar-admin></x-sidebar-admin> --}}

        <!-- Main Content -->
        <div class="flex-auto p-10 space-y-8">

            <!-- Header -->
            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold">Welcome, <span
                        class="text-4xl text-red-700">{{ Auth::user()->name }}!</span></h1>
                <div class="flex items-center space-x-4">
                    <input type="text" placeholder="Search..."
                        class="px-4 py-2 rounded-xl border focus:ring-2 focus:ring-blue-500">

                    <!-- Notification Icon -->
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open"
                            class="bg-blue-500 hover:bg-blue-700 text-white rounded-full w-10 h-10 flex items-center justify-center">
                            <i class="fa-regular fa-bell"></i>
                        </button>
                        <!-- Notification Dropdown -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                            style="display: none;">
                            <div class="py-1">
                                <p class="block px-4 py-2 text-sm text-gray-700">No new notifications</p>
                                <!-- Add more notification items here if needed -->
                            </div>
                        </div>
                    </div>

                    <!-- Profile Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none">
                                <img class="h-9 w-9 rounded-full bg-red-500"/>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('admin.profile') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>  

            <!-- Categories -->
            <div class="grid grid-cols-3 gap-4">
                <a href="#" class="bg-green-300 p-3 h-24 rounded-lg inline-flex flex-row items-center justify-around space-y-2 hover:bg-green-400 transition duration-300">
                    <i class="fa-solid fa-user text-4xl text-black"></i>
                    <div class="flex flex-col space-y-2 ml-2">
                        <h1 class="font-bold text-black lg:text-3xl md:text-lg sm:text-base">Total User</h1>
                        <h1
                            class="font-bold text-2xl bg-gradient-to-tl from-red-600 to-yellow-500 bg-clip-text text-transparent">
                            {{ $total_user }}
                        </h1>
                    </div>
                </a>


                <a href="#"
                    class="bg-yellow-300 p-3 h-24 rounded-lg inline-flex flex-row items-center justify-around space-y-2 hover:bg-yellow-400 transition duration-300">
                    <i class="fa-solid fa-book text-4xl text-black"></i>
                    <div class="flex flex-col space-y-2 ml-2">
                        <h1 class="font-bold text-black lg:text-3xl md:text-lg sm:text-base">Total Buku</h1>
                        <h1
                            class="font-bold text-2xl bg-gradient-to-tl from-red-600 to-yellow-500 bg-clip-text text-transparent">
                            {{ $total_buku }}
                        </h1>
                    </div>
                </a>

                <a href="#" class="bg-red-300 p-3 h-24 rounded-lg inline-flex flex-row items-center justify-around space-y-2 hover:bg-red-400 transition duration-300">
                    <i class="fa-solid fa-bookmark text-4xl text-black"></i>
                    <div class="flex flex-col space-y-2 ml-2">
                        <h1 class="font-bold text-black lg:text-3xl md:text-lg sm:text-base">Total Penjualan</h1>
                        <h1
                            class="font-bold text-2xl bg-gradient-to-tl from-red-600 to-yellow-500 bg-clip-text text-transparent">
                            {{ $total_penjualan }}
                        </h1>
                    </div>
                </a>

            </div>

            <!-- Popular Genre & Rating -->
            <div class="flex space-x-6">
                <!-- Genre Terlaris -->
                <div class="bg-gray-200 p-4 rounded-md w-1/2">
                    <h1 class="font-bold mb-4">Genre Terlaris</h1>
                    <ul class="list-decimal pl-5 space-y-2">
                        @foreach ($topgenre as $genre)
                        <li>{{ $genre->nama_genre }} ({{ $genre->views }} Kunjungan)</li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-gray-200 p-4 rounded-md w-1/2">
                    <h1 class="font-bold mb-4">Kategori Terlaris</h1>
                    <ul class="list-decimal pl-5 space-y-2">
                        @foreach ($topkategori as $kategori)
                        <li>{{ $kategori->nama_kategori }} ({{ $kategori->jumlah_kunjungan }} Kunjungan)</li>
                        @endforeach
                    </ul>
                </div>
                <!-- Rating -->
                <div class="bg-gray-200 p-4 rounded-md w-1/2">
                    <h2 class="font-bold mb-4">Rating</h2>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox">
                            <span class="text-yellow-500">★</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="checkbox">
                            <span class="text-yellow-500">★★</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="checkbox">
                            <span class="text-yellow-500">★★★</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="checkbox">
                            <span class="text-yellow-500">★★★★</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="checkbox">
                            <span class="text-yellow-500">★★★★★</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.getElementById('bookMenuToggle').addEventListener('click', function(event) {
            event.preventDefault();
            var subMenu = document.getElementById('bookSubMenu');
            subMenu.classList.toggle('hidden');
        });

        document.getElementById('transactionToggle').addEventListener('click', function(event) {
            event.preventDefault();
            var subMenu = document.getElementById('transactionSubMenu');
            subMenu.classList.toggle('hidden');
        });

        document.getElementById('commentToggle').addEventListener('click', function(event) {
            event.preventDefault();
            var subMenu = document.getElementById('commentSubMenu');
            subMenu.classList.toggle('hidden');
        });

        document.getElementById('settingToggle').addEventListener('click', function(event) {
            event.preventDefault();
            var subMenu = document.getElementById('settingSubMenu');
            subMenu.classList.toggle('hidden');
        });
    </script> --}}
</x-admin-layout>
