<div x-data="{ hamburgerOpen: false }" class="flex items-center">
    <button @click="hamburgerOpen = !hamburgerOpen" class="p-2 rounded-md focus:outline-none">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path :class="{'hidden': hamburgerOpen, 'block': !hamburgerOpen }" class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            <path :class="{'block': hamburgerOpen, 'hidden': !hamburgerOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div>