<x-app-layout>
    <!-- File: resources/views/transaksi/show.blade.php -->

    <section class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Detail Transaksi</h2>
        <div class="space-y-6">
            <!-- Detail Buku -->
            <div class="space-y-2">
                <div class="flex justify-between">
                    <p class="text-gray-700 font-medium"><strong>Judul:</strong> {{ $book->nama_buku }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-700"><strong>Karya:</strong> {{ $book->penulis }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-700"><strong>Harga:</strong> Rp{{ number_format($book->harga, 0, ',', '.') }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-700">
                        <strong>Status Transaksi:</strong>
                        <span class="font-semibold {{ $transaksi->status == 'success' ? 'text-green-500' : 'text-yellow-500' }}">
                            {{ ucfirst($transaksi->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Separator -->
            <hr class="border-gray-300">

            <!-- Actions -->
            @if ($transaksi->status === 'success')
                <!-- Tombol untuk melihat struk dan unduh buku -->
                <div class="mt-6 space-y-4">
                    <a href="{{ route('transaksi.struk', $transaksi->id) }}"
                        class="block text-center px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition duration-200">
                        Lihat Struk
                    </a>
                    <a href="{{ asset('storage/' . $book->file_buku) }}"
                        class="block text-center px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200" download>
                        Unduh Buku
                    </a>
                </div>

                <!-- Link Kembali -->
                <a href="/dashboard" class="mt-6 inline-block text-[#377CC7] hover:underline"> &larr; Kembali</a>
            @else
                <!-- Tombol Checkout untuk transaksi pending -->
                <form action="{{ route('transaksi.checkout', $transaksi->id) }}" method="POST" class="mt-6">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-200 w-full sm:w-auto">
                        Check Out
                    </button>
                </form>
            @endif
        </div>
    </section>

</x-app-layout>
