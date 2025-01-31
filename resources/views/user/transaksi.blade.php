<x-app-layout>
    <main class="max-w-4xl mx-auto mt-10">
        {{-- Header --}}
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Detail Transaksi</h1>
        </div>

        {{-- Konten Utama --}}
        <div class="mt-6 grid grid-cols-3 gap-6">
            {{-- Informasi Buku --}}
            <section class="bg-gray-100 p-6 rounded-lg shadow-md">
                {{-- Cover Buku --}}
                <div class="flex justify-center">
                    <img src="{{ asset('storage/' . $book->image_cover) }}" alt="{{ $book->nama_buku }}"
                         class="w-40 h-auto rounded-lg border border-gray-300 shadow">
                </div>
                {{-- Judul Buku --}}
                <h2 class="mt-4 text-lg font-semibold text-gray-800">{{ $book->nama_buku }}</h2>
                {{-- Informasi Tambahan --}}
                <p class="mt-2 text-gray-700">
                    <strong>Karya:</strong> {{ $book->penulis }}
                </p>
                <p class="mt-1 text-gray-700">
                    <strong>Genre:</strong> {{ $book->genres->pluck('nama_genre')->join(', ') }}
                </p>
                <p class="mt-1 text-gray-700">
                    <strong>Harga:</strong> Rp{{ number_format($book->harga, 0, ',', '.') }}
                </p>
                {{-- Tombol Kembali --}}
                <a href="/home" class="mt-4 inline-block text-blue-500 hover:underline">&larr; Kembali</a>
            </section>

            {{-- Detail Transaksi --}}
            <section class="col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-800">Detail Transaksi</h2>
                <div class="mt-4">
                    <p class="text-gray-700">
                        <strong>Judul:</strong> {{ $book->nama_buku }}
                    </p>
                    <p class="mt-1 text-gray-700">
                        <strong>Karya:</strong> {{ $book->penulis }}
                    </p>
                    <p class="mt-1 text-gray-700">
                        <strong>Harga:</strong> Rp{{ number_format($book->harga - 2000, 0, ',', '.') }}
                    </p>
                    <p class="mt-1 text-gray-700">
                        <strong>Biaya Layanan:</strong> Rp1.000
                    </p>
                    <p class="mt-1 text-gray-700">
                        <strong>Biaya Jasa Aplikasi:</strong> Rp1.000
                    </p>
                    <hr class="my-4 border-gray-300">
                    <p class="text-lg font-semibold text-gray-800">
                        <strong>Total Tagihan:</strong> Rp{{ number_format($book->harga, 0, ',', '.') }}
                    </p>
                </div>
                {{-- Form untuk Checkout --}}
                <form action="{{ route('transaksi.store', $book->id) }}" method="POST">
                    @csrf
                    <div class="flex flex-col space-y-4 mt-6">
                        {{-- Pilih metode pembayaran --}}
                        {{-- <div>
                            <label class="text-gray-700" for="metode_pembayaran">Metode Pembayaran</label>
                            <select id="metode_pembayaran" name="metode_pembayaran" class="block w-full mt-2 border-gray-300 rounded">
                                <option value="Gopay">Gopay</option>
                                <option value="BCA">BCA</option>
                                <option value="BNI">BNI</option>
                                <option value="Maestro">Maestro</option>
                            </select>
                        </div> --}}
                        <div x-data="{ metodePembayaran: '', open: false }" class="relative">
                            <label class="text-gray-700" for="metode_pembayaran">Metode Pembayaran</label>
                            
                            <!-- Dropdown Toggler -->
                            <button type="button" 
                                @click="open = !open" 
                                class="block w-full mt-2 border-gray-300 bg-white rounded flex justify-between items-center px-3 py-2 shadow-sm">
                                <span x-text="metodePembayaran || 'Pilih Metode Pembayaran'" class="text-gray-600"></span>
                                <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        
                            <!-- Dropdown Options -->
                            <div x-show="open" 
                                @click.outside="open = false"
                                class="absolute z-10 mt-2 bg-white border rounded shadow-md w-full">
                                <ul class="divide-y divide-gray-200">
                                    <li @click="metodePembayaran = 'Gopay'; open = false" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                        <img src="{{ asset('img/gopay.png') }}" alt="Gopay" class="w-8 h-8 mr-3">
                                        <span>Gopay</span>
                                    </li>
                                    <li @click="metodePembayaran = 'BCA'; open = false" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                        <img src="{{ asset('img/bca.png') }}" alt="BCA" class="w-8 h-8 mr-3">
                                        <span>BCA</span>
                                    </li>
                                    <li @click="metodePembayaran = 'BNI'; open = false" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                        <img src="{{ asset('img/bni.png') }}" alt="BNI" class="w-8 h-8 mr-3">
                                        <span>BNI</span>
                                    </li>
                                    <li @click="metodePembayaran = 'Maestro'; open = false" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                                        <img src="{{ asset('img/maestro.png') }}" alt="Maestro" class="w-8 h-8 mr-3">
                                        <span>Maestro</span>
                                    </li>
                                </ul>
                            </div>
                            <input type="hidden" name="metode_pembayaran" x-model="metodePembayaran">
                        </div>
                        

                        {{-- Tombol Checkout --}}
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Check Out
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</x-app-layout>
