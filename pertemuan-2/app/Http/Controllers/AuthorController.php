<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all(); // Ambil data dari model
        return view('authors.index', compact('authors')); // Kirim ke view
    }
}
