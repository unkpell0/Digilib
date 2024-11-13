<div class="min-h-screen flex flex-col lg:w-3/5 w-full sm:justify-center items-center pt-4 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mx-2 my-4 px-6 py-3 text-base bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
