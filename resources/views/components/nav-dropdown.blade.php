@props(['active'])

<div x-data="{ genreOpen: false }" class="relative inline-block text-left">
    <button @click="genreOpen = ! genreOpen" class="inline-flex items-center mt-px px-2 py-1 text-lg font-semibold leading-5 rounded-full btn_navbar transition duration-150 ease-in-out">
        {{ __('Genre') }}
        <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
    </button>
    
    <div x-show="genreOpen" @click.away="genreOpen = false" class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
        <div class="py-1 flex flex-col">
            @foreach ($genres as $genre)
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    {{ $genre->nama_genre }}
                </a>
            @endforeach
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
