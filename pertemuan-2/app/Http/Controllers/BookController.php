<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Eager load relasi author dan genre untuk efisiensi query
        $books = Book::with(['author', 'genre'])->get();
        return view('books.index', compact('books'));
    }
}
