<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class StruckController extends Controller
{
    public function generateStruk($id)
    {
        // Ambil data transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);
        
        // Data yang akan ditampilkan di struk
        $data = [
            'transaksi' => $transaksi,
        ];

        // Menggunakan DomPDF untuk generate PDF dari view
        $pdf = Pdf::loadView('user.struk', $data);
        
        // Mendownload file PDF
        return $pdf->download('struk-transaksi-' . $transaksi->id . '.pdf');
    }
}
