<?php

namespace App\Http\Controllers;

use App\Models\Book;

class IndexController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->take(10)->get();

        return view('index', compact('books'));
    }
}
