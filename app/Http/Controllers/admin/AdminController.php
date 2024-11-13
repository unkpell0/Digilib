<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $total_user = User::count();
        return view('admin.dashboard',compact('users','total_user'));
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
