<x-app-layout>
    <div class="bg-white p-8 my-4 rounded-md shadow-sm flex justify-around items-center">
            <h1 class="text-2xl font-semibold font-sans">You <span class="text-red-500 text-4xl">DEFINE</span> your own life</h1>
            <img src="{{ asset('img/imghome.jpeg') }}" alt="" class="w-36">
    </div>
    <div class="w-full mx-auto bg-white shadow-md p-6 border-l-4 border-white">
        <!-- Search Bar -->
        <div class="flex justify-end mb-6 p-2 rounded-full">
            <div class="flex items-center max-w-md space-x-2 bg-gray-200 py-2 px-3 rounded-full">
                <input type="text" placeholder="Search"
                    class="flex-grow p-2 bg-white-200 focus:outline-none rounded-full focus:ring-0">
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>


        <!-- Tabs for Category -->

        <div class="flex justify-center space-x-2 mb-6">
            <!-- Manga Button -->
            <button
                class="px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-emerald-500 hover:text-white focus:bg-emerald-500 focus:text-white">
                Manga
            </button>

            <!-- Novel Button -->
            <button
                class="ml-2 px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-sky-400 hover:text-white focus:bg-sky-400 focus:text-white">
                Novel
            </button>


        </div>

        <!-- Title -->
        <h2 class="text-xl font-bold mb-6 text-center">Mass Released !!</h2>

        <!-- Content Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Di responsive -->
            <a href="#"> 
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('img/imghome.jpeg') }}" alt="Roshidere" class="w-full h-64 object-cover">
                    <div class="p-2 bg-blue-500 text-white text-center">
                        Roshidere
                    </div>
                </div>
            </a>

            <!-- Empty Slots to be filled dynamically -->
            <div class="bg-gray-200 h-64 flex items-center justify-center rounded-lg">
                <p>Empty Slot</p>
            </div>
            <div class="bg-gray-200 h-64 flex items-center justify-center rounded-lg">
                <p>Empty Slot</p>
            </div>
            <div class="bg-gray-200 h-64 flex items-center justify-center rounded-lg">
                <p>Empty Slot</p>
            </div>
        </div>
    </div>
</x-app-layout>
