<x-admin-layout>
    <div class="container mx-auto px-4 py-8 flex flex-col space-y-4">
        <h1 class="text-3xl font-bold">Rekap Transaksi</h1>

        <!-- Tombol Rekap -->
        <a href="#" class="bg-blue-500 text-white py-2 px-4 rounded shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200 max-w-fit">
            Rekap Transaksi
        </a>

        <!-- Tabel -->
        <table class="min-w-full bg-white border border-gray-200 rounded shadow-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">User ID</th>
                    <th class="px-4 py-2 text-left">Buku ID</th>
                    <th class="px-4 py-2 text-left">Total Harga</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Tanggal Transaksi</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $no => $item)
                    <tr>
                        <td class="px-4 py-2">{{ $no+1 }}</td>
                        <td class="px-4 py-2">{{ $item->user_id }}</td>
                        <td class="px-4 py-2">{{ $item->buku_id }}</td>
                        <td class="px-4 py-2">{{ $item->total_harga }}</td>
                        <td class="px-4 py-2">
                            @if ($item->status === 'success')
                                <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">Success</span>
                            @elseif ($item->status === 'pending')
                                <span class="bg-yellow-200 text-yellow-700 py-1 px-3 rounded-full text-xs">Pending</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $item->tanggal_transaksi }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');" style="display: inline;">
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
