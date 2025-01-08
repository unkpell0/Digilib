<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Keranjang</h1>

        <!-- List Buku di Keranjang -->
        @if ($details->count() > 0)
            <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="select-all" class="mr-2" />
                    <span class="text-lg">Semua</span>
                    <button class="ml-auto flex items-center text-gray-500">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                    </button>
                </div>

                <!-- Loop Buku di Keranjang -->
                @foreach ($details as $detail)
                    <div class="bg-gray-100 p-4 rounded-lg mb-4">
                        <div class="flex items-center bg-white p-4 rounded-lg shadow-md">
                            <input type="checkbox" class="mr-2 item-checkbox" />
                            <img src="{{ asset('storage/' . ($detail->book->image_cover ?? 'default.jpg')) }}"
                                alt="Book cover of {{ $detail->book->nama_buku ?? 'Unknown Book' }}"
                                class="w-20 h-28 mr-4 object-contain rounded-lg"
                                style="max-width: 100%; max-height: 100%;" />
                            <div class="flex-1">
                                <h2 class="text-lg font-semibold mb-2">{{ $detail->book->nama_buku }}</h2>
                                <div class="flex items-center">
                                    <span
                                        class="text-xl font-bold text-gray-800">Rp{{ number_format($detail->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <!-- Tombol Hapus -->
                                <form action="{{ route('cart.delete', $detail->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <div class="flex items-center mx-4">
                                    <!-- Tombol Kurangi -->
                                    <form action="{{ route('cart.store', $detail->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ $detail->quantity - 1 }}">
                                        <button class="text-gray-500">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </form>
                                    <!-- Jumlah Buku -->
                                    <span class="mx-2">{{ $detail->quantity }}</span>
                                    <!-- Tombol Tambah -->
                                    <form action="{{ route('cart.store', $detail->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ $detail->quantity + 1 }}">
                                        <button class="text-gray-500">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center p-4 bg-white rounded-lg shadow-md">
                <p>Keranjang Anda kosong.</p>
            </div>
        @endif

        <!-- Ringkasan Keranjang -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Ringkasan Keranjang</h2>
            <div class="flex justify-between mb-2">
                <span>Total Harga ({{ $details->sum('quantity') }} Barang)</span>
                <span>Rp{{ number_format($details->sum(fn($item) => $item->harga * $item->quantity), 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span>Diskon Belanja</span>
                <span class="text-red-500">-Rp0</span>
            </div>
            <hr class="mb-4" />
            <div class="flex justify-between mb-4">
                <span class="text-lg font-bold">Subtotal</span>
                <span
                    class="text-lg font-bold">Rp{{ number_format($details->sum(fn($item) => $item->harga * $item->quantity), 0, ',', '.') }}</span>
            </div>
            <button class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">Checkout</button>
        </div>
    </div>

    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
</x-app-layout>
