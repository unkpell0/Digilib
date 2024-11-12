<x-admin-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Detail Kategori</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <p class="mb-4"><strong>Nama Kategori:</strong> {{ $kategori->nama_kategori }}</p>
            <p><strong>Jumlah Kunjungan:</strong> {{ $kategori->jumlah_kunjungan }}</p>
        </div>
        <a href="{{ route('kategori.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">Kembali</a>
    </div>
</x-admin-layout>