<div class="w-52 bg-gray-900 text-white flex flex-col items-center py-6">
    <!-- Logo -->
    <img src="{{ asset('logo/logo digilib.png') }}" alt="logo digilib" class="w-32 mb-6 rounded-full">

    <nav class="flex flex-col space-y-5 w-full mt-3">
        <!-- Dashboard -->
        <a href="/admin"
           class="flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded-md">
            <div class="flex items-center space-x-3">
                <i class="fa-solid fa-house-chimney"></i>
                <span>Dashboard</span>
            </div>
        </a>

        <!-- Buku -->
        <div class="group">
            <button id="bookMenuToggle"
                    class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-700 rounded-md">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-book"></i>
                    <h1>Buku</h1>
                </div>
                <i id="bookArrow" class="fa-solid fa-angle-down transition-transform duration-200"></i>
            </button>
            <div id="bookSubMenu" class="hidden pl-10 space-y-2 mt-1">
                <a href="{{ route('buku.index') }}" class="block px-3 py-1 hover:bg-gray-600 rounded-md">CRUD Buku</a>
                <a href="{{ route('genre.index') }}" class="block px-3 py-1 hover:bg-gray-600 rounded-md">GENRE</a>
                <a href="{{ route('kategori.index') }}" class="block px-3 py-1 hover:bg-gray-600 rounded-md">KATEGORI</a>
            </div>
        </div>

        <!-- Transaksi -->
        <div class="group">
            <button id="transactionToggle"
                    class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-700 rounded-md">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Transaksi</span>
                </div>
                <i id="transactionArrow" class="fa-solid fa-angle-down transition-transform duration-200"></i>
            </button>
            <div id="transactionSubMenu" class="hidden pl-10 space-y-2 mt-1">
                <a href="{{ route('transaksi.index') }}" class="block w-full px-4 py-1 hover:bg-gray-600 rounded-md">
                    Rekap Transaksi
                </a>
            </div>
        </div>

        <!-- Ulasan -->
        <div class="group">
            <button id="commentToggle"
                    class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-700 rounded-md">
                <div class="flex items-center space-x-3">
                    <i class="fa-regular fa-comment"></i>
                    <span>Ulasan</span>
                </div>
                <i id="commentArrow" class="fa-solid fa-angle-down transition-transform duration-200"></i>
            </button>
            <div id="commentSubMenu" class="hidden pl-10 space-y-2 mt-1">
                <a href="#" class="block px-4 py-1 hover:bg-gray-600 rounded-md">Daftar Ulasan</a>
                <a href="#" class="block px-4 py-1 hover:bg-gray-600 rounded-md">Filter Ulasan</a>
            </div>
        </div>

        <!-- Pengaturan -->
        <div class="group">
            <button id="settingToggle"
                    class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-700 rounded-md">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-gear"></i>
                    <span>Pengaturan</span>
                </div>
                <i id="settingArrow" class="fa-solid fa-angle-down transition-transform duration-200"></i>
            </button>
            <div id="settingSubMenu" class="hidden pl-10 space-y-2 mt-1">
                <a href="{{ route('setting.index') }}" class="block px-3 py-1 hover:bg-gray-600 rounded-md">Pengaturan Umum</a>
                <a href="#" class="block px-3 py-1 hover:bg-gray-600 rounded-md">Pengaturan Lanjut</a>
            </div>
        </div>

        <!-- Logout -->
        <div class="group">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex items-center justify-between px-4 py-2 hover:bg-gray-700 rounded-md w-full">
                    <div class="flex items-center space-x-3">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </div>
                </button>
            </form>
        </div>
    </nav>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {

        // Variabel global untuk submenu yang sedang terbuka
        let currentlyOpen = null;
        let currentlyOpenArrow = null;

        // Fungsi toggle 'solo mode'
        function toggleMenu(subMenu, arrow) {
            // Jika ada submenu lain terbuka dan bukan submenu ini, tutup dulu
            if (currentlyOpen && currentlyOpen !== subMenu) {
                currentlyOpen.classList.add('hidden');
                currentlyOpenArrow.classList.remove('rotate-180');
            }

            // Cek apakah submenu saat ini sedang tersembunyi
            if (subMenu.classList.contains('hidden')) {
                // Buka submenu
                subMenu.classList.remove('hidden');
                arrow.classList.add('rotate-180');
                // Set submenu ini sebagai "currentlyOpen"
                currentlyOpen = subMenu;
                currentlyOpenArrow = arrow;
            } else {
                // Tutup submenu
                subMenu.classList.add('hidden');
                arrow.classList.remove('rotate-180');
                currentlyOpen = null;
                currentlyOpenArrow = null;
            }
        }

        // --- Buku ---
        const bookToggle = document.getElementById('bookMenuToggle');
        const bookSubMenu = document.getElementById('bookSubMenu');
        const bookArrow = document.getElementById('bookArrow');
        bookToggle.addEventListener('click', function () {
            toggleMenu(bookSubMenu, bookArrow);
        });

        // --- Transaksi ---
        const transactionToggle = document.getElementById('transactionToggle');
        const transactionSubMenu = document.getElementById('transactionSubMenu');
        const transactionArrow = document.getElementById('transactionArrow');
        transactionToggle.addEventListener('click', function () {
            toggleMenu(transactionSubMenu, transactionArrow);
        });

        // --- Ulasan ---
        const commentToggle = document.getElementById('commentToggle');
        const commentSubMenu = document.getElementById('commentSubMenu');
        const commentArrow = document.getElementById('commentArrow');
        commentToggle.addEventListener('click', function () {
            toggleMenu(commentSubMenu, commentArrow);
        });

        // --- Pengaturan ---
        const settingToggle = document.getElementById('settingToggle');
        const settingSubMenu = document.getElementById('settingSubMenu');
        const settingArrow = document.getElementById('settingArrow');
        settingToggle.addEventListener('click', function () {
            toggleMenu(settingSubMenu, settingArrow);
        });

    });
</script>
@endpush
