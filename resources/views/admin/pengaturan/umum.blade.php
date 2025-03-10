<x-admin-layout>
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Pengaturan Umum</h1>

        {{-- Tampilkan pesan sukses/error jika ada --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form untuk menambahkan foto slide -->
        <form action="{{ route('slide.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="slide_image" class="block font-semibold mb-1">Pilih Gambar Slide:</label>
                <input type="file" name="slide_image" id="slide_image" 
                       class="block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Field judul slide (opsional) -->
            <div>
                <label for="title" class="block font-semibold mb-1">Judul (opsional):</label>
                <input type="text" name="title" id="title" 
                       class="block w-full border border-gray-300 rounded p-2">
            </div>

            <!-- Field deskripsi slide (opsional) -->
            <div>
                <label for="description" class="block font-semibold mb-1">Deskripsi (opsional):</label>
                <textarea name="description" id="description" rows="3"
                          class="block w-full border border-gray-300 rounded p-2"></textarea>
            </div>

            <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Slide
            </button>
        </form>

        <!-- Daftar slide yang sudah diupload (array/list) -->
        @if(isset($slides) && $slides->count() > 0)
            <div class="mt-8">
                <h2 class="text-xl font-bold mb-2">Daftar Slide</h2>
                <ul class="space-y-4">
                    @foreach($slides as $slide)
                        <li class="flex items-center space-x-4 border p-2 rounded bg-gray-50">
                            <img src="{{ asset('storage/slides/' . $slide->image) }}" 
                                 alt="Slide" 
                                 class="w-32 h-32 object-cover rounded">
                            <div>
                                <h3 class="font-semibold">{{ $slide->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $slide->description }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <p class="mt-8 text-gray-600">Belum ada slide yang diupload.</p>
        @endif
    </div>
</x-admin-layout>
