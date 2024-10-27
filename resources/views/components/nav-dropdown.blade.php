@props(['active'])

<div x-data="{ genreOpen: false }" class="relative inline-block text-left">
    <button @click="genreOpen = ! genreOpen" class="inline-flex items-center mt-px px-2 py-1 text-sm font-medium leading-5 text-gray-500 rounded-full hover:text-gray-800 hover:underline-offset-1 hover:bg-gray-100 hover:rounded-full focus:outline-none focus:text-gray-700 focus:bg-gray-100 focus:rounded-full transition duration-150 ease-in-out">
        {{ __('Genre') }}
        <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
    </button>
    
    <div x-show="genreOpen" @click.away="genreOpen = false" class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
        <div class="py-1 flex flex-col">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Horror</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Romance</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Drama</a>
        </div>
    </div>
</div>


<script>
    // Menggunakan Alpine.js untuk toggling dropdown
    document.addEventListener('alpine:init', () => {
        Alpine.data('dropdown', () => ({
            open: false,
            toggle() {
                this.open = !this.open;
            },
            close() {
                this.open = false;
            }
        }));
    });
</script>
