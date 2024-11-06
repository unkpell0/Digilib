<x-admin-layout>
    {{-- container --}}
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-52 bg-zinc-600 text-white flex flex-col items-center py-6">
            <!-- Logo -->
            <img src="{{ asset('logo/logo digilib 2.png') }}" alt="logo digilib" class="w-24 mb-6 rounded-full">

            <!-- SideBar -->
            <nav class="flex flex-col space-y-5 w-full mt-3">
                {{-- Dashboard Link --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded-md">
                    <div class="flex items-center space-x-3">
                        <i class="fa-solid fa-house-chimney"></i>
                        <span>Dashboard</span>
                    </div>
                </a>

                {{-- Book --}}
                <div class="group">
                    <a href="#" id="bookMenuToggle"
                        class="flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded-md">
                        <div class="flex items-center space-x-3">
                            <i class="fa-solid fa-book"></i>
                            <span>Buku</span>
                        </div>
                        <i class="fa-solid fa-angle-down"></i>
                    </a>

                    {{-- Submenu for Buku --}}
                    <div id="bookSubMenu" class="hidden pl-10 space-y-2 mt-1">
                        <a href="#" class="block px-4 py-1 hover:bg-gray-600 rounded-md">CRUD Buku</a>
                        <a href="#" class="block px-4 py-1 hover:bg-gray-600 rounded-md">GENRE</a>
                        <a href="#" class="block px-4 py-1 hover:bg-gray-600 rounded-md">KATEGORI</a>
                    </div>

                </div>

                <a href="#" class="flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded-md">
                    <div class="flex items-center space-x-3">
                        <i class="fa-solid fa-receipt"></i>
                        <span>Transaksi</span>
                    </div>
                    <i class="fa-solid fa-angle-down"></i>
                </a>

                {{-- Link Comment --}}
                <div class="group">
                    <a href="#" class="flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded-md">
                        <div class="flex items-center space-x-3">
                            <i class="fa-regular fa-comment"></i>
                            <span>Ulasan</span>
                        </div>
                        <i class="fa-solid fa-angle-down"></i>
                    </a>
                    <div class="hidden group-hover:block pl-10 space-y-2 mt-1">
                        <a href="#" class="block px-4 py-1 hover:bg-gray-600 rounded-md">Daftar Ulasan</a>
                        <a href="#" class="block px-4 py-1 hover:bg-gray-600 rounded-md">Filter Ulasan</a>
                    </div>
                </div>

                {{-- Halaman setting --}}
                <div class="group">
                    <a href="#" class="flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded-md">
                        <div class="flex items-center space-x-3">
                            <i class="fa-solid fa-gear"></i>
                            <span>Pengaturan</span>
                        </div>
                        <i class="fa-solid fa-angle-down"></i>
                    </a>
                    <div class="hidden group-hover:block pl-10 space-y-2 mt-1">
                        <a href="#" class="block px-4 py-1 hover:bg-gray-600 rounded-md">Pengaturan Umum</a>
                        <a href="#" class="block px-4 py-1 hover:bg-gray-600 rounded-md">Pengaturan Lanjutan</a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10 space-y-8">

            <!-- Header -->
            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold">Welcome, <span class="text-4xl text-purple-700">Admin!</span></h1>
                <div class="flex items-center space-x-4">
                    <input type="text" placeholder="Search..."
                        class="px-4 py-2 rounded-xl border focus:ring-2 focus:ring-blue-500">
                    <div
                        class="bg-red-500 hover:bg-red-700 text-white rounded-full w-10 h-10 flex items-center justify-center cursor-pointer">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div
                        class="bg-blue-500 hover:bg-blue-700 text-white rounded-full w-10 h-10 flex items-center justify-center cursor-pointer">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-green-300 p-3 h-24 rounded-lg inline-flex flex-row items-center justify-around space-y-2">
                    <i class="fa-solid fa-user text-4xl text-black"></i>
                    <div class="flex flex-col space-y-2 ml-2">
                        <h1 class="font-bold text-black lg:text-3xl md:text-lg sm:text-base">Total User</h1>
                        <h1 class="font-bold text-2xl bg-gradient-to-tl from-red-600 to-yellow-500 bg-clip-text text-transparent">5000</h1>
                    </div>
                </div>
                <div class="bg-yellow-300 h-24 rounded-lg flex items-center justify-center font-semibold text-xl">Genre
                    2</div>
                <div class="bg-red-300 h-24 rounded-lg flex items-center justify-center font-semibold text-xl">Genre 3
                </div>
            </div>

            <!-- Popular Genre & Rating -->
            <div class="flex space-x-6">
                <!-- Genre Terlaris -->
                <div class="bg-gray-200 p-4 rounded-md w-1/2">
                    <h2 class="font-bold mb-4">Genre Terlaris</h2>
                    <ul class="list-decimal pl-5 space-y-2">
                        <li>Romance</li>
                        <li>Fiction</li>
                        <li>Action</li>
                        <li>Horror</li>
                        <li>Slice of Life</li>
                        <!-- etc... -->
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

    <script>
        document.getElementById('bookMenuToggle').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah navigasi default dari <a>
            var subMenu = document.getElementById('bookSubMenu');
            subMenu.classList.toggle('hidden'); // Menambah atau menghapus kelas "hidden"
        });
        // document.getElementById('bookMenuToggle').addEventListener('click', function(event) {
        //     event.preventDefault(); // Mencegah navigasi default dari <a>
        //     var subMenu = document.getElementById('bookSubMenu');

        //     // Toggling hidden class and applying animations
        //     if (subMenu.classList.contains('hidden')){
        //         subMenu.classList.remove('hidden');
        //         subMenu.classList.remove('scale-95', 'opacity-0');
        //         subMenu.classList.add('scale-100', 'opacity-100');
        //     } else{
        //         subMenu.classList.add('scale-95', 'opacity-0');
        //         setTimeout(() => subMenu.classList.add('hidden'), 200);
        //     }
        // });
    </script>

</x-admin-layout>
