<x-admin-layout>
    <div class="container mx-auto p-5">
        <h1 class="text-2xl font-semibold text-center text-gray-700 mb-6">Add New Book</h1>
        <div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow-lg border border-gray-200">
            <form action="{{ route('admin.book.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Book Title -->
                <div class="mb-3">
                    <label for="title" class="block text-gray-600 font-medium mb-1">Book Title</label>
                    <input type="text" name="title" id="title"
                        class="form-input w-full border-gray-300 rounded-lg" required>
                </div>

                <div class="flex flex-row w-full space-x-3">
                    <!-- Author -->
                    <div class="mb-3 w-full">
                        <label for="author" class="block text-gray-600 font-medium mb-1">Author</label>
                        <input type="text" name="author" id="author"
                            class="form-input w-full border-gray-300 rounded-lg" required>
                    </div>

                    <!-- Publisher -->
                    <div class="mb-3 w-full">
                        <label for="publisher" class="block text-gray-600 font-medium mb-1">Publisher</label>
                        <input type="text" name="publisher" id="publisher"
                            class="form-input w-full border-gray-300 rounded-lg" required>
                    </div>
                </div>

                <!-- Genre -->
                <div class="flex flex-row w-full space-x-3">
                    <div class="mb-3 w-full">
                        <label for="genre" class="block text-gray-600 font-medium mb-1">Genre</label>
                        <select name="genre" id="genre" class="form-select w-full border-gray-300 rounded-lg"
                            required>
                            <option value="Romance">Romance</option>
                            <option value="Fiction">Fiction</option>
                            <option value="Action">Action</option>
                            <option value="Horror">Horror</option>
                            <option value="Slice of Life">Slice of Life</option>
                            <!-- Add more genres as needed -->
                        </select>
                    </div>

                    <!-- Category -->
                    <div class="mb-3 w-full">
                        <label for="category" class="block text-gray-600 font-medium mb-1">Category</label>
                        <select name="category" id="category" class="form-select w-full border-gray-300 rounded-lg"
                            required>
                            <option value="New Release">New Release</option>
                            <option value="Best Seller">Best Seller</option>
                            <option value="Classic">Classic</option>
                            <option value="Recommended">Recommended</option>
                            <!-- Add more categories as needed -->
                        </select>
                    </div>
                </div>


                <!-- Price -->
                <div class="mb-3">
                    <label for="price" class="block text-gray-600 font-medium mb-1">Price (Rp)</label>
                    <input type="number" name="price" id="price"
                        class="form-input w-full border-gray-300 rounded-lg" step="0.01" min="0" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="block text-gray-600 font-medium mb-1">Description</label>
                    <textarea name="description" id="description" class="form-input w-full border-gray-300 rounded-lg" rows="4"></textarea>
                </div>

                <!-- Book Cover (Image) -->
                <div class="mb-3">
                    <label for="cover" class="block text-gray-600 font-medium mb-1">Book Cover (Image)</label>
                    <input type="file" name="cover" id="cover"
                        class="form-input w-full border-gray-300 rounded-lg" accept="image/*" required>
                </div>

                <!-- Book File (PDF) -->
                <div class="mb-6">
                    <label for="file" class="block text-gray-600 font-medium mb-1">Book File (PDF)</label>
                    <input type="file" name="file" id="file"
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
