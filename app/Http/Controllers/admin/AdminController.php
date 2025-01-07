<?php

namespace App\Http\Controllers\admin;

use App\Models\Book;
use App\Models\User;
use App\Models\Genre;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kategori;

class AdminController extends Controller
{
    public function dashboard()
    {
        $topkategori = Kategori::orderBy('jumlah_kunjungan','DESC')->get();
        $topgenre =  Genre::orderBy('views','DESC')->get();
        $total_user = User::count();
        $total_buku = Book::count();
        $total_penjualan = Transaksi::where('status','success')->count();
        return view('admin.dashboard',compact('topkategori','topgenre','total_user','total_buku','total_penjualan'));
    }
    public function book()
    {
        return view('admin.book.index');
    }
    public function transaction()
    {
        // return view('admin.transaction');
    }
    public function comment()
    {
        return view('admin.comment');
    }
    public function settings()
    {
        return view('admin.settings');
    }
    public function profile()
    {
        return view('admin.profile');
    }
}
