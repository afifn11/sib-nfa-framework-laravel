<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    /**
     * Menampilkan daftar semua buku.
     * GET /api/books
     */
    public function index(): JsonResponse
    {
        $books = Book::all();
        
        return response()->json([
            'success' => true,
            'message' => 'Data books berhasil diambil',
            'data' => $books
        ]);
    }
}