<x-app-layout>
    <!-- File: resources/views/transaksi/show.blade.php -->

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
            <strong>Harga:</strong> Rp{{ number_format($book->harga, 0, ',', '.') }}
        </p>
        <p class="mt-1 text-gray-700">
            <strong>Status Transaksi:</strong> 
            <span class="font-semibold {{ $transaksi->status == 'success' ? 'text-green-500' : 'text-yellow-500' }}">
                {{ ucfirst($transaksi->status) }}
            </span>
        </p>
        <hr class="my-4 border-gray-300">
        @if ($transaksi->status === 'success')
            <p class="text-lg font-semibold text-gray-800">
                <strong>Total Tagihan:</strong> Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}
            </p>
            {{-- Tombol untuk melihat buku --}}
            <a href="/books/{{ $book->id }}"
               class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                See Book
            </a>
        @else
            <button disabled
                class="px-4 py-2 bg-gray-400 text-white rounded cursor-not-allowed">
                See Book
            </button>
        @endif
    </div>
    <div class="flex gap-4 mt-6">
        {{-- Tombol Check Out --}}
        <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            Check Out
        </button>
    </div>
</section>

</x-app-layout>