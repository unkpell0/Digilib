<x-admin-layout>
    <div class="container mx-auto p-5">
        <h1 class="text-2xl font-semibold text-center text-gray-700 mb-6">Edit Book</h1>
        <div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow-lg border border-gray-200">
            <form action="{{ route('admin.book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Book Title -->
                <div class="mb-3">
                    <label for="title" class="block text-gray-600 font-medium mb-1">Book Title</label>
                    <input type="text" name="title" id="title"
                        class="form-input w-full border-gray-300 rounded-lg" value="{{ $book->title }}" required>
                </div>

                <div class="flex flex-row w-full space-x-3">
                    <!-- Author -->
                    <div class="mb-3 w-full">
                        <label for="author" class="block text-gray-600 font-medium mb-1">Author</label>
                        <input type="text" name="author" id="author"
                            class="form-input w-full border-gray-300 rounded-lg" value="{{ $book->author }}" required>
                    </div>

                    <!-- Publisher -->
                    <div class="mb-3 w-full">
                        <label for="publisher" class="block text-gray-600 font-medium mb-1">Publisher</label>
                        <input type="text" name="publisher" id="publisher"
                            class="form-input w-full border-gray-300 rounded-lg" value="{{ $book->publisher }}" required>
                    </div>
                </div>

                <!-- Genre -->
                <div class="flex flex-row w-full space-x-3">
                    <div class="mb-3 w-full">
                        <label for="genre" class="block text-gray-600 font-medium mb-1">Genre</label>
                        <select name="genre" id="genre" class="form-select w-full border-gray-300 rounded-lg" required>
                            <option value="Romance" {{ $book->genre == 'Romance' ? 'selected' : '' }}>Romance</option>
                            <option value="Fiction" {{ $book->genre == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                            <option value="Action" {{ $book->genre == 'Action' ? 'selected' : '' }}>Action</option>
                            <option value="Horror" {{ $book->genre == 'Horror' ? 'selected' : '' }}>Horror</option>
                            <option value="Slice of Life" {{ $book->genre == 'Slice of Life' ? 'selected' : '' }}>Slice of Life</option>
                        </select>
                    </div>

                    <!-- Category -->
                    <div class="mb-3 w-full">
                        <label for="category" class="block text-gray-600 font-medium mb-1">Category</label>
                        <select name="category" id="category" class="form-select w-full border-gray-300 rounded-lg" required>
                            <option value="New Release" {{ $book->category == 'New Release' ? 'selected' : '' }}>New Release</option>
                            <option value="Best Seller" {{ $book->category == 'Best Seller' ? 'selected' : '' }}>Best Seller</option>
                            <option value="Classic" {{ $book->category == 'Classic' ? 'selected' : '' }}>Classic</option>
                            <option value="Recommended" {{ $book->category == 'Recommended' ? 'selected' : '' }}>Recommended</option>
                        </select>
                    </div>
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label for="price" class="block text-gray-600 font-medium mb-1">Price (Rp)</label>
                    <input type="number" name="price" id="price" class="form-input w-full border-gray-300 rounded-lg"
                        step="0.01" min="0" value="{{ $book->price }}" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="block text-gray-600 font-medium mb-1">Description</label>
                    <textarea name="description" id="description" class="form-input w-full border-gray-300 rounded-lg" rows="4">{{ $book->description }}</textarea>
                </div>

                <!-- Book Cover (Image) -->
                <div class="mb-3">
                    <label for="cover" class="block text-gray-600 font-medium mb-1">Book Cover (Image)</label>
                    <input type="file" name="cover" id="cover" class="form-input w-full border-gray-300 rounded-lg" accept="image/*">
                    @if ($book->cover)
                        <p class="mt-2 text-sm">Current Cover: <img src="{{ asset('storage/' . $book->cover) }}" alt="Book Cover" class="w-20 h-20 object-cover mt-2"></p>
                    @endif
                </div>

                <!-- Book File (PDF) -->
                <div class="mb-6">
                    <label for="file" class="block text-gray-600 font-medium mb-1">Book File (PDF)</label>
                    <input type="file" name="file" id="file" class="form-input w-full border-gray-300 rounded-lg" accept="application/pdf">
                    @if ($book->file)
                        <p class="mt-2 text-sm">Current File: <a href="{{ asset('storage/' . $book->file) }}" class="text-blue-500 underline" target="_blank">View PDF</a></p>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-700 transition">
                        Update Book
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
