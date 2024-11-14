<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $books = Book::all();
        return view('dashboard', compact('books'));
    }
}
