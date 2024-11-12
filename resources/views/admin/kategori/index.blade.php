<x-admin-layout>
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Daftar Kategori</h1>
    <a href="{{ route('kategori.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Kategori</a>
    <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
        <thead>
            <tr>
                <th class="py-3 px-6 bg-gray-200 text-gray-600 font-semibold">Nama Kategori</th>
                <th class="py-3 px-6 bg-gray-200 text-gray-600 font-semibold">Jumlah Kunjungan</th>
                <th class="py-3 px-6 bg-gray-200 text-gray-600 font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoris as $kategori)
            <tr class="border-b">
                <td class="py-4 px-6">{{ $kategori->nama_kategori }}</td>
                <td class="py-4 px-6">{{ $kategori->jumlah_kunjungan }}</td>
                <td class="py-4 px-6 flex space-x-2">
                    <a href="{{ route('kategori.show', $kategori) }}" class="bg-teal-500 text-white px-4 py-2 rounded">Lihat</a>
                    <a href="{{ route('kategori.edit', $kategori) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                    <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-admin-layout>
