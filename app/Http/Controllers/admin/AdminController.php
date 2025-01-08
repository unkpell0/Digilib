<?php

namespace App\Http\Controllers\admin;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $total_user = User::count();
        $book_count = Book::count();
        return view('admin.dashboard',compact('users','total_user', 'book_count'));
    }
    public function book()
    {
        return view('admin.book.index');
    }
    public function transaction()
    {
        return view('admin.transaction');
    }
    public function comment()
    {
        return view('admin.comment');
    }
    public function settings()
    {
        return view('admin.settings');
    }
}
