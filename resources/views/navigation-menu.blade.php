<nav id="navbar" x-data="{ open: false }"
    class="fixed top-0 left-0 right-0 bg-white border-b border-gray-100 z-50 transition-colors duration-300">
    <div class="max-w-screen mx-auto px-4 sm:px-3 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center ms-4">
                <a href="{{ route('home') }}">
                    <x-application-mark class="block h-9 w-auto" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex flex-1 justify-center space-x-4">
                @auth
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('explore') }}" :active="request()->routeIs('explore')">
                        {{ __('Explore') }}
                    </x-nav-link>
                @else
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link href="javascript:void(0)" onclick="showModal()" :active="false">
                        {{ __('Explore') }}
                    </x-nav-link>
                @endauth
            </div>

            <!-- User Menu -->
            <div class="flex items-center space-x-2">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center px-3 py-2 border border-transparent text-sm font-medium text-gray-500 bg-white rounded-md hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    {{ Auth::user()->currentTeam->name }}
                                    <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>
                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>
                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                {{-- user --}}
                @auth
                        <a href="#">
                            <i class="fa-solid fa-bag-shopping cursor-pointer text-xl hover:text-gray-600 mx-2"></i>
                        </a>
                        <a href="/cart">
                            <i class="fa-solid fa-cart-shopping cursor-pointer text-xl hover:text-gray-600 mx-2"></i>
                        </a>
                    <x-dropdown align="right" width="w-80">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none">
                                <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                                    alt="{{ Auth::user()->name }}" />
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="p-4 flex items-center space-x-4 border-b">
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile Photo"
                                    class="h-12 w-12 rounded-full">
                                <div>
                                    <h2 class="text-lg text-gray-950 font-semibold">{{ Auth::user()->name }}</h2>
                                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fa-solid fa-arrow-right-from-bracket text-gray-600"></i>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="relative z-30">
                        <button onclick="togglePopup()"
                            class="flex items-center text-sm border-2 border-transparent rounded-full">
                            <img class="h-8 w-8 rounded-full" src="{{ asset('logo/guest.jpg') }}" alt="Guest Profile" />
                        </button>
                        <div id="popup"
                            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden">
                            <div class="p-4 text-sm text-gray-700">Kamu belum login</div>
                            <div class="border-t">
                                <button onclick="window.location='{{ route('login') }}'"
                                    class="block w-full text-left px-4 py-2 text-slate-800">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="border-t">
                                <button onclick="window.location='{{ route('register') }}'"
                                    class="block w-full text-left px-4 py-2 text-slate-800">
                                    Register
                                </button>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <div id="authModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-80">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Anda belum login</h2>
            <p class="text-gray-700 mb-6">Silakan login atau register untuk melanjutkan.</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Tutup</button>
                <button onclick="window.location.href='{{ route('login') }}'"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Login
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- JavaScript untuk mengubah warna navbar -->
<script>
    function togglePopup() {
        const popup = document.getElementById('popup');
        popup.classList.toggle('hidden');
    }

    function showModal() {
        document.getElementById('authModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('authModal').classList.add('hidden');
    }

    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.remove('bg-white');
            navbar.classList.add('bg-sky-400', 'shadow-lg', 'text-white');
        } else {
            navbar.classList.add('bg-white');
            navbar.classList.remove('bg-sky-400', 'shadow-lg', 'text-white');
        }
    });
</script>
