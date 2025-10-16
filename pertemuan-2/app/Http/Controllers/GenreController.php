<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        // Menggunakan view dalam folder 'genres' untuk konsistensi
        return view('genres.index', compact('genres'));
    }
}
