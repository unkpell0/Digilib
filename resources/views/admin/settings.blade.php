<x-admin-layout>
    {{-- container --}}
    <div class="flex flex-row">

        {{-- sidebar --}}
        <div class="bg-slate-600 z-10 px-2.5">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('logo/logo digilib 2.png') }}" alt="logo digilib" class="w-36">
            </div>

            <div>
                <a href="" class="flex my-8 space-x-3 text-2xl font-semibold"><i class="fa-solid fa-book"></i></i>
                    <h1>Buku</h1>
                </a>
                <a href="" class="flex my-8 space-x-3 text-2xl font-semibold"><i
                        class="fa-solid fa-house-chimney"></i>
                    <h1>Dashboard</h1>
                </a>
                <a href="" class="flex my-8 space-x-3 text-2xl font-semibold"><i
                        class="fa-solid fa-receipt"></i></i>
                    <h1>Transaksi</h1>
                </a>
                <a href="" class="flex my-8 space-x-3 text-2xl font-semibold"><i
                        class="fa-regular fa-comment"></i>
                    <h1>Ulasan</h1>
                </a>
                <a href="" class="flex my-8 space-x-3 text-2xl font-semibold"><i class="fa-solid fa-gear"></i>
                    <h1>Pengaturan</h1>
                </a>
            </div>
        </div>

        {{-- navbar --}}
        <div class="bg-red-500 w-screen h-16 flex justify-end">
            <button class=" text-white px-4 py-2 z-20 hover:text-black">
                <i class="fa-solid fa-user text-xl"></i>
            </button>
        </div>

        {{-- isi --}}
        <div class="bg-blue-400">

        </div>

    </div>
</x-admin-layout>
