<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Genre</h1>
    
        <form action="{{ route('genre.update', $genre->id) }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block font-medium text-gray-700">Nama Genre</label>
                <input type="text" name="nama_genre" value="{{ $genre->nama_genre }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300">
            </div>
    
            <div>
                <label class="block font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300">{{ $genre->deskripsi }}</textarea>
            </div>
    
            <div>
                <label class="block font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" value="{{ $genre->slug }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300">
            </div>
    
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
        </form>
    </div>
</x-admin-layout>