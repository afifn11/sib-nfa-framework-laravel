<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Get book data with author and genre relations (Eager Loading)
        $books = Book::with(['author', 'genre'])->get();

        // Return the data in JSON format
        return response()->json([
            'status' => 'success',
            'data' => $books
        ]);
    }
}

