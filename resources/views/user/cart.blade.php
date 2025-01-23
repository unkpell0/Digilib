<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Keranjang</h1>

        <!-- List Buku di Keranjang -->
        @if ($details->count() > 0)
            <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                    <div class="flex items-center mb-4">
                        <input type="checkbox" id="select-all" class="mr-2" />
                        <span class="text-lg">Pilih Semua</span>
                        <button type="button" id="delete-selected" class="ml-auto flex items-center text-gray-500">
                            <i class="fas fa-trash-alt mr-2"></i> Hapus
                        </button>
                    </div>

                    <!-- Loop Buku di Keranjang -->
                    @foreach ($details as $detail)
                        <div class="bg-gray-100 p-4 rounded-lg mb-4">
                            <div class="flex items-center bg-white p-4 rounded-lg shadow-md">
                                <input type="checkbox" name="selected_items[]" value="{{ $detail->id }}"
                                    class="mr-2 item-checkbox" data-price="{{ $detail->harga }}"
                                    data-quantity="{{ $detail->quantity }}" />
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
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Ringkasan Keranjang -->
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Ringkasan Keranjang</h2>
                    <div class="flex justify-between mb-2">
                        <span>Total Harga (<span id="total-barang">{{ $details->sum('quantity') }}
                                Barang</span>)</span>
                        <span id="total-harga">Rp0</span>
                    </div>

                    <div class="flex justify-between mb-2">
                        <span>Diskon Belanja</span>
                        <span class="text-red-500">-Rp0</span>
                    </div>
                    <hr class="mb-4" />
                    <div class="flex justify-between mb-4">
                        <span class="text-lg font-bold">Subtotal</span>
                        <span id="subtotal" class="text-lg font-bold">
                            Rp0
                        </span>
                    </div>


                    <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">
                        Checkout
                    </button>
                </div>
            </form>
        @else
            <div class="text-center p-4 bg-white rounded-lg shadow-md">
                <p>Keranjang Anda kosong.</p>
            </div>
        @endif
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const selectAllCheckbox = document.querySelector('#select-all');
    const totalHargaEl = document.querySelector('#total-harga');
    const totalBarangEl = document.querySelector('#total-barang');
    const subtotalEl = document.querySelector('#subtotal');
    const deleteSelectedBtn = document.getElementById('delete-selected'); // Tombol hapus

    // Fungsi untuk memperbarui total harga, jumlah barang, dan subtotal
    function updateSummary() {
        let totalHarga = 0;
        let totalBarang = 0;
        let subtotal = 0;

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const price = parseInt(checkbox.getAttribute('data-price'), 10);
                const quantity = parseInt(checkbox.getAttribute('data-quantity'), 10);
                totalHarga += price * quantity;
                totalBarang += quantity;
                subtotal += price * quantity; // Menghitung subtotal
            }
        });

        // Update nilai ringkasan di DOM
        totalHargaEl.textContent = `Rp${totalHarga.toLocaleString('id-ID')}`;
        totalBarangEl.textContent = `${totalBarang} Barang`;
        subtotalEl.textContent = `Rp${subtotal.toLocaleString('id-ID')}`;
    }

    // Update summary saat checkbox berubah
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSummary);
    });

    // Fungsi untuk memilih/deselect semua checkbox
    selectAllCheckbox.addEventListener('change', function() {
        const isChecked = selectAllCheckbox.checked;
        checkboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        updateSummary();
    });

    // Update summary saat pertama kali halaman dimuat
    updateSummary();

    // Fungsi untuk menghapus item yang dipilih
    deleteSelectedBtn.addEventListener('click', function () {
        const selectedItems = Array.from(document.querySelectorAll('.item-checkbox:checked'))
            .map(checkbox => checkbox.value);

        if (selectedItems.length > 0) {
            if (confirm('Apakah Anda yakin ingin menghapus item yang dipilih?')) {
                fetch("{{ route('cart.delete_selected') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids: selectedItems })
                }).then(response => {
                    if (response.ok) {
                        location.reload(); // Reload halaman setelah penghapusan
                    } else {
                        alert('Gagal menghapus item.');
                    }
                });
            }
        } else {
            alert('Tidak ada item yang dipilih.');
        }
    });
});

    </script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const totalHargaEl = document.querySelector('#total-harga');
            const totalBarangEl = document.querySelector('#total-barang');

            // Fungsi untuk memperbarui total harga dan total barang berdasarkan checkbox yang dipilih
            function updateSummary() {
                let totalHarga = 0;
                let totalBarang = 0;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const price = parseInt(checkbox.getAttribute('data-price'), 10);
                        const quantity = parseInt(checkbox.getAttribute('data-quantity'), 10);
                        totalHarga += price * quantity;
                        totalBarang += quantity;
                    }
                });

                // Update nilai total harga dan jumlah barang di DOM
                totalHargaEl.textContent = `Rp${totalHarga.toLocaleString('id-ID')}`;
                totalBarangEl.textContent = `${totalBarang} Barang`;
            }

            // Update summary saat checkbox berubah
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSummary);
            });

            // Update summary saat pertama kali halaman dimuat
            updateSummary();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const totalHargaEl = document.querySelector('#total-harga');
            const totalBarangEl = document.querySelector('#total-barang');
            const subtotalEl = document.querySelector('#subtotal');

            // Fungsi untuk memperbarui total harga, jumlah barang, dan subtotal
            function updateSummary() {
                let totalHarga = 0;
                let totalBarang = 0;
                let subtotal = 0;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const price = parseInt(checkbox.getAttribute('data-price'), 10);
                        const quantity = parseInt(checkbox.getAttribute('data-quantity'), 10);
                        totalHarga += price * quantity;
                        totalBarang += quantity;
                        subtotal += price * quantity; // Menghitung subtotal
                    }
                });

                // Update nilai ringkasan di DOM
                totalHargaEl.textContent = `Rp${totalHarga.toLocaleString('id-ID')}`;
                totalBarangEl.textContent = `${totalBarang} Barang`;
                subtotalEl.textContent = `Rp${subtotal.toLocaleString('id-ID')}`;
            }

            // Update summary saat checkbox berubah
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSummary);
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const selectAllCheckbox = document.querySelector('#select-all');
            const totalHargaEl = document.querySelector('#total-harga');
            const totalBarangEl = document.querySelector('#total-barang');

            // Fungsi untuk memperbarui total harga dan jumlah barang
            function updateSummary() {
                let totalHarga = 0;
                let totalBarang = 0;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const price = parseInt(checkbox.getAttribute('data-price'), 10);
                        const quantity = parseInt(checkbox.getAttribute('data-quantity'), 10);
                        totalHarga += price * quantity;
                        totalBarang += quantity;
                        subtotal += price * quantity;
                    }
                });

                // Update nilai ringkasan di DOM
                totalHargaEl.textContent = `Rp${totalHarga.toLocaleString('id-ID')}`;
                totalBarangEl.textContent = `${totalBarang} Barang`;
            }

            // Update summary saat checkbox berubah
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSummary);
            });

            // Fungsi untuk memilih/deselect semua checkbox
            selectAllCheckbox.addEventListener('change', function() {
                const isChecked = selectAllCheckbox.checked;
                checkboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
                updateSummary();
            });
        });
    </script> --}}
</x-app-layout>
