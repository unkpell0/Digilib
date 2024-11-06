<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
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
