<x-admin-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Tambah Kategori</h1>
        <form action="{{ route('kategori.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="nama_kategori" class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="border border-gray-300 rounded w-full py-2 px-3" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-admin-layout>