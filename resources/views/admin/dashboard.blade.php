<x-admin-layout>
    {{-- container --}}
    <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-black text-white flex flex-col items-center py-6">
        <!-- Logo -->
        <img src="{{ asset('logo/logo digilib 2.png') }}" alt="logo digilib" class="w-24 mb-6 rounded-full">
        
        <!-- Menu Items -->
        <nav class="flex flex-col space-y-4 w-full">
            <a href="#" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-700 rounded-md">
                <i class="fa-solid fa-house-chimney"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-700 rounded-md">
                <i class="fa-solid fa-book"></i>
                <span>Buku</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-700 rounded-md">
                <i class="fa-solid fa-receipt"></i>
                <span>Transaksi</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-700 rounded-md">
                <i class="fa-regular fa-comment"></i>
                <span>Ulasan</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-700 rounded-md">
                <i class="fa-solid fa-gear"></i>
                <span>Pengaturan</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-10 space-y-8">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Dashboard</h1>
            <div class="flex items-center space-x-4">
                <input type="text" placeholder="Search..." class="px-4 py-2 rounded-md border focus:ring-2 focus:ring-blue-500">
                <div class="bg-red-500 text-white rounded-full w-10 h-10 flex items-center justify-center cursor-pointer">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="grid grid-cols-4 gap-4">
            <div class="bg-green-300 h-24 rounded-lg flex items-center justify-center font-semibold text-xl">Genre 1</div>
            <div class="bg-yellow-300 h-24 rounded-lg flex items-center justify-center font-semibold text-xl">Genre 2</div>
            <div class="bg-red-300 h-24 rounded-lg flex items-center justify-center font-semibold text-xl">Genre 3</div>
            <div class="bg-black h-24 rounded-lg flex items-center justify-center font-semibold text-xl text-white">Genre 4</div>
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

</x-admin-layout>
