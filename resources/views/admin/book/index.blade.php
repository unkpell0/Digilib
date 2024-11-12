<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Daftar Buku</h1>

        <a href="{{ route('buku.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Buku</a>

        <table class="min-w-full bg-white border border-gray-200 rounded shadow-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Nama Buku</th>
                    <th class="px-4 py-2 text-left">Penulis</th>
                    <th class="px-4 py-2 text-left">Rating</th>
                    <th class="px-4 py-2 text-left">Harga</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td class="px-4 py-2">{{ $book->nama_buku }}</td>
                        <td class="px-4 py-2">{{ $book->penulis }}</td>
                        <td class="px-4 py-2">{{ $book->rating }}</td>
                        <td class="px-4 py-2">{{ $book->harga }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('buku.edit', $book) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                            <form action="{{ route('buku.destroy', $book) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
