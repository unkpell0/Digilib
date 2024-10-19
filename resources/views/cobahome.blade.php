<html>

<head>
    <title>
        DigiLib
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <header class="bg-blue-500 text-white flex justify-between items-center p-4">
        <div class="flex items-center">
            <div class="bg-yellow-500 rounded-full p-2">
                <span class="text-2xl font-bold">
                    DL
                </span>
            </div>
            <span class="ml-2 text-xl font-semibold">
                DigiLib
            </span>
        </div>
        <nav class="flex space-x-4">
            <a class="hover:underline" href="#">
                Home
            </a>
            <div class="relative group">
                <a class="hover:underline" href="#">
                    Genre
                    <i class="fas fa-caret-down">
                    </i>
                </a>
                <div class="absolute hidden group-hover:block bg-white text-black mt-1 rounded shadow-lg">
                    <a class="block px-4 py-2 hover:bg-gray-200" href="#">
                        Genre 1
                    </a>
                    <a class="block px-4 py-2 hover:bg-gray-200" href="#">
                        Genre 2
                    </a>
                </div>
            </div>
            <div class="relative group">
                <a class="hover:underline" href="#">
                    Populer
                    <i class="fas fa-caret-down">
                    </i>
                </a>
                <div class="absolute hidden group-hover:block bg-white text-black mt-1 rounded shadow-lg">
                    <a class="block px-4 py-2 hover:bg-gray-200" href="#">
                        Populer 1
                    </a>
                    <a class="block px-4 py-2 hover:bg-gray-200" href="#">
                        Populer 2
                    </a>
                </div>
            </div>
        </nav>
        <div class="flex space-x-4">
            <i class="fas fa-shopping-cart">
            </i>
            <i class="fas fa-bars">
            </i>
        </div>
    </header>
    <div class="flex">
        <aside class="bg-blue-500 text-white w-64 p-4">
            <div class="mb-4">
                <button class="w-full text-left">
                    Menu
                </button>
            </div>
            <div class="mb-4">
                <button class="w-full text-left">
                    Katalog Buku
                </button>
                <div class="ml-4">
                    <a class="block" href="#">
                        Genre
                    </a>
                    <a class="block" href="#">
                        Bahasa
                    </a>
                    <a class="block" href="#">
                        Penulis
                    </a>
                    <a class="block" href="#">
                        Terbaru
                    </a>
                </div>
            </div>
            <div class="mb-4">
                <button class="w-full text-left">
                    Wishlist
                </button>
            </div>
            <div class="mb-4">
                <button class="w-full text-left">
                    Members
                </button>
            </div>
            <div class="mb-4">
                <button class="w-full text-left">
                    Cara Pakai?
                </button>
            </div>
        </aside>
        <main class="flex-1 p-4">
            <section class="bg-white p-8 rounded shadow-md mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold">
                        You
                        <span class="font-bold">
                            define
                        </span>
                        your own life.
                    </h1>
                </div>
                <img alt="Smiling anime character" class="rounded-lg" height="100"
                    src="https://storage.googleapis.com/a1aa/image/LbB0vPIw2mYSFBg9lHPGwFoF3kxSceljysmCW1iLKUno8K0JA.jpg"
                    width="100" />
            </section>
            <section class="bg-gray-300 p-8 rounded shadow-md mb-8 text-center">
                <p class="text-xl font-semibold">
                    "TIDAK ADA KATA TERLAMBAT UNTUK MENIMBA ILMU"
                </p>
            </section>
            <section class="bg-white p-8 rounded shadow-md mb-8">
                <div class="flex justify-between items-center mb-4">
                    <input class="border rounded p-2 w-1/2" placeholder="search bar" type="text" />
                    <div class="flex space-x-4">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded">
                            Manga
                        </button>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded">
                            Novel
                        </button>
                    </div>
                </div>
                <h2 class="text-xl font-semibold mb-4">
                    MASS RELEASED !!
                </h2>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-gray-300 p-4 rounded">
                        <img alt="Cover of Roshidere manga" class="mb-2" height="150"
                            src="https://storage.googleapis.com/a1aa/image/0N8Gp3j31CbcOdfpYvYeUFE73OxGf0hGtYPluScfPp78kXhOB.jpg"
                            width="100" />
                        <p class="text-center">
                            Roshidere
                        </p>
                    </div>
                    <div class="bg-gray-300 p-4 rounded">
                        <p class="text-center">
                            buku
                        </p>
                    </div>
                    <div class="bg-gray-300 p-4 rounded">
                    </div>
                    <div class="bg-gray-300 p-4 rounded">
                    </div>
                    <div class="bg-gray-300 p-4 rounded">
                    </div>
                    <div class="bg-gray-300 p-4 rounded">
                    </div>
                </div>
            </section>
            <section class="bg-black text-white p-8 rounded shadow-md flex justify-between items-center">
                <h2 class="text-xl font-semibold">
                    Change Your Life Starts Now!
                </h2>
                <img alt="Anime character with determined expression" class="rounded-lg" height="100"
                    src="https://storage.googleapis.com/a1aa/image/M6nsSkM9TQJfSKY55blAaNYPEhjAJ1LzyJn18xuSWNLo8K0JA.jpg"
                    width="100" />
            </section>
        </main>
    </div>
</body>

</html>
