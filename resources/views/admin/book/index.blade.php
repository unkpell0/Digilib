<x-admin-layout>
    <div class="container mx-auto px-5 py-4">
        <!-- Pesan Keberhasilan -->
        @if (session('success'))
            <div id="success-message"
                class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-400 text-green-700 text-center">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="text-2xl font-semibold text-center text-gray-700 mb-6 -translate-x-5">Book List</h1>
        <div class="flex flex-col max-w-7xl mx-auto p-6 bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="flex justify-end mb-2">
                <a href="{{ route('admin.book.add') }}"
                    class="flex items-center justify-center text-center w-48 h-10 bg-sky-400 hover:bg-sky-500 font-semibold tracking-wide uppercase text-lg text-white shadow-md rounded-lg">
                    Add Your Book!
                </a>
            </div>
            <table class="min-w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 font-medium text-gray-700 border-b">#</th>
                        <th class="p-3 font-medium text-gray-700 border-b">Cover</th>
                        <th class="p-3 font-medium text-gray-700 border-b">Title</th>
                        <th class="p-3 font-medium text-gray-700 border-b">Author</th>
                        <th class="p-3 font-medium text-gray-700 border-b">Genre</th>
                        <th class="p-3 font-medium text-gray-700 border-b">Category</th>
                        <th class="p-3 font-medium text-gray-700 border-b">Price</th>
                        <th class="p-3 font-medium text-gray-700 border-b">PDF File</th>
                        <th class="p-3 font-medium text-gray-700 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $index => $book)
                        <tr class="border-b">
                            <td class="p-3">{{ $index + 1 }}</td>
                            <!-- Cover Image -->
                            <td class="p-3">
                                <img src="{{ asset('storage/' . $book->book_cover) }}" alt="Cover Image" class="w-16 h-20 object-cover rounded-md">
                            </td>
                            <td class="p-3">{{ $book->title }}</td>
                            <td class="p-3">{{ $book->author }}</td>
                            <td class="p-3">{{ $book->genre }}</td>
                            <td class="p-3">{{ $book->category }}</td>
                            <td class="p-3">Rp{{ number_format($book->price, 0, ',', '.') }}</td>
                            <!-- PDF File Name -->
                            <td class="p-3">
                                <a href="{{ asset('storage/' . $book->pdf_file) }}" target="_blank" class="text-blue-600 hover:underline">
                                    {{ basename($book->pdf_file) }}
                                </a>
                            </td>
                            <td class="p-3 text-center">
                                <a href="{{ route('admin.book.edit', $book->id) }}" class="text-blue-600 hover:underline">Edit</a> |
                                <form action="{{ route('admin.book.destroy', $book->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script untuk menyembunyikan pesan setelah beberapa detik -->
    <script>
        setTimeout(() => {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000); // Menghilangkan pesan setelah 3 detik
    </script>
</x-admin-layout>
