<x-admin-layout>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Daftar Genre</h1>
    
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('genre.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Tambah Genre</a>

    <div class="mt-6">
        <ul class="space-y-4">
            @foreach ($genres as $genre)
                <li class="flex items-center justify-between bg-white p-4 rounded shadow-md">
                    <div>
                        <a href="{{ route('genre.show', $genre->id) }}" class="text-xl font-semibold text-gray-800 hover:underline">
                            {{ $genre->nama_genre }}
                        </a>
                    </div>
                    <div class="space-x-2">
                        <a href="{{ route('genre.edit', $genre->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <form action="{{ route('genre.destroy', $genre->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
</x-admin-layout>