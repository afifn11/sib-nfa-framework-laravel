<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
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

    /**
     * Menyimpan buku baru ke database.
     * POST /api/books
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'isbn' => 'nullable|string|max:17|unique:books',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'pages' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'is_available' => 'nullable|boolean',
        ]);

        $book = Book::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Book berhasil ditambahkan',
            'data' => $book
        ], 201);
    }
}