<div x-data="{ hamburgerOpen: false }" class="flex items-center">
    <button @click="hamburgerOpen = !hamburgerOpen" class="p-2 rounded-md focus:outline-none">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path :class="{'hidden': hamburgerOpen, 'block': !hamburgerOpen }" class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            <path :class="{'block': hamburgerOpen, 'hidden': !hamburgerOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    
<!-- Responsive Navigation Menu -->
<div :class="{ 'block': open, 'hidden': !open }" class="">
    <div class="pb-3 space-y-1">
        <x-responsive-nav-link href="{{ route('dashboard.index') }}">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="#">
            {{ __('Genre') }}
        </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="border-t border-gray-200">
        <div class="flex items-center px-4 py-2">
            <img class="h-10 w-10 rounded-full object-cover"
                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            <div class="ml-3">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>
        </div>

        <div class="mt-3 space-y-1">
            <x-responsive-nav-link href="{{ route('profile.show') }}">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</div>
</div>
