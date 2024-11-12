<div class="w-52 bg-zinc-600 text-white flex flex-col items-center py-6">
    <!-- Logo -->
    <img src="{{ asset('logo/logo digilib 2.png') }}" alt="logo digilib" class="w-24 mb-6 rounded-full">

    <nav class="flex flex-col space-y-5 w-full mt-3">
        {{-- Dashboard Link --}}
        <a href="/admin"
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
                <a href="{{ route('buku.index') }}" class="block px-3 py-1 hover:bg-gray-600 rounded-md">CRUD Buku</a>
                <a href="{{ route('genre.index') }}" class="block px-3 py-1 hover:bg-gray-600 rounded-md">GENRE</a>
                <a href="{{ route('kategori.index') }}" class="block px-3 py-1 hover:bg-gray-600 rounded-md">KATEGORI</a>
            </div>

        </div>

        <div class="group">
            <a href="#" id="transactionToggle" class="flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded-md">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Transaksi</span>
                </div>
                <i class="fa-solid fa-angle-down"></i>
            </a>
            {{-- Submenu for Buku --}}
            <div id="transactionSubMenu" class="hidden pl-10 space-y-2 mt-1">
                <a href="#" class="block px-4 py-1 hover:bg-gray-600 rounded-md">Detail Transaksi</a>
            </div>
        </div>

        {{-- Link Comment --}}
        <div class="group">
            <a href="#" id="commentToggle" class="flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded-md">
                <div class="flex items-center space-x-3">
                    <i class="fa-regular fa-comment"></i>
                    <span>Ulasan</span>
                </div>
                <i class="fa-solid fa-angle-down"></i>
            </a>
            <div id="commentSubMenu" class="hidden pl-10 space-y-2 mt-1">
                <a href="#" class="block px-4 py-1 hover:bg-gray-600 rounded-md">Daftar Ulasan</a>
                <a href="#" class="block px-4 py-1 hover:bg-gray-600 rounded-md">Filter Ulasan</a>
            </div>
        </div>

        {{-- Halaman setting --}}
        <div class="group">
            <a href="#" id="settingToggle" class="flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded-md">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-gear"></i>
                    <span>Pengaturan</span>
                </div>
                <i class="fa-solid fa-angle-down"></i>
            </a>
            <div id="settingSubMenu" class="hidden pl-10 space-y-2 mt-1">
                <a href="#" class="block px-3 py-1 hover:bg-gray-600 rounded-md">Pengaturan Umum</a>
                <a href="#" class="block px-3 py-1 hover:bg-gray-600 rounded-md">Pengaturan Lanjut</a>
            </div>
            <div class="group mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded-md w-full">
                        <div class="flex items-center space-x-3">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Toggle Book Submenu
        document.getElementById('bookMenuToggle').addEventListener('click', function () {
            document.getElementById('bookSubMenu').classList.toggle('hidden');
        });

        // Toggle Transaction Submenu
        document.getElementById('transactionToggle').addEventListener('click', function () {
            document.getElementById('transactionSubMenu').classList.toggle('hidden');
        });

        // Toggle Comment Submenu
        document.getElementById('commentToggle').addEventListener('click', function () {
            document.getElementById('commentSubMenu').classList.toggle('hidden');
        });

        // Toggle Setting Submenu
        document.getElementById('settingToggle').addEventListener('click', function () {
            document.getElementById('settingSubMenu').classList.toggle('hidden');
        });
    });
</script>
@endpush