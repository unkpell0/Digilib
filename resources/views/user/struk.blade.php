<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 400px;
            margin: auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h1 {
            text-align: center;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Struk Pembelian</h1>
        <p>Transaksi ID: {{ $transaksi->id }}</p>
        <p>Tanggal: {{ $transaksi->created_at }}</p>

        <div class="details">
            <p>Nama Buku: {{ $transaksi->buku->nama_buku }}</p>
            <p>Karya: {{ $transaksi->buku->penulis }}</p>
            <p class="total">Total: Rp. {{ number_format($transaksi->buku->harga, 0, ',', '.') }}</p>
            <p>Status: {{ $transaksi->status }}</p>
        </div>

        <p>Terima kasih atas pembelian Anda!</p>
    </div>
</body>
</html>
