<x-admin-layout>
    <div class="container mx-auto p-5">
        <h1 class="text-2xl font-semibold text-center text-gray-700 mb-6">Add New Book</h1>
        <div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow-lg border border-gray-200">
            <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Book Title -->
                <div class="mb-3">
                    <label for="nama_buku" class="block text-gray-600 font-medium mb-1">Book Title</label>
                    <input type="text" name="nama_buku" id="nama_buku"
                        class="form-input w-full border-gray-300 rounded-lg" required>
                </div>

                <div class="flex flex-row w-full space-x-3">
                    <!-- Author -->
                    <div class="mb-3 w-full">
                        <label for="penulis" class="block text-gray-600 font-medium mb-1">Author</label>
                        <input type="text" name="penulis" id="penulis"
                            class="form-input w-full border-gray-300 rounded-lg" required>
                    </div>
                </div>

                <!-- Genre -->
                <div class="flex flex-row w-full space-x-3">
                    <div class="mb-3 w-full">
                        <label for="genres" class="block text-gray-600 font-medium mb-1">Select Genre(s)</label>
                        <select name="genres[]" id="genres" class="form-select w-full border-gray-300 rounded-lg" multiple required>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->nama_genre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category -->
                    <div class="mb-3 w-full">
                        <label for="kategori_id" class="block text-gray-600 font-medium mb-1">Category</label>
                        <select name="kategori_id" id="kategori_id" class="form-select w-full border-gray-300 rounded-lg" required>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label for="harga" class="block text-gray-600 font-medium mb-1">Price (Rp)</label>
                    <input type="number" name="harga" id="harga"
                        class="form-input w-full border-gray-300 rounded-lg" step="0.01" min="0" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="deskripsi" class="block text-gray-600 font-medium mb-1">Description</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-input w-full border-gray-300 rounded-lg" rows="4"></textarea>
                </div>


                <!-- Book Cover (Image) -->
                <div class="mb-3">
                    <label for="image_cover" class="block text-gray-600 font-medium mb-1">Book Cover (Image)</label>
                    <input type="file" name="image_cover" id="image_cover"
                        class="form-input w-full border-gray-300 rounded-lg" accept="image/*" required>
                </div>

                <!-- Book File (PDF) -->
                <div class="mb-6">
                    <label for="file_buku" class="block text-gray-600 font-medium mb-1">Book File (PDF)</label>
                    <input type="file" name="file_buku" id="file_buku"
                        class="form-input w-full border-gray-300 rounded-lg" accept="application/pdf" required>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit"
                        class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-700 transition">
                        Save Book
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
