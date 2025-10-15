<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    /**
     * Menampilkan daftar semua buku beserta author dan genre-nya.
     * GET /api/books
     */
    public function index(): JsonResponse
    {
        $books = Book::with(['author', 'genres'])->get();
        
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
            'genre_ids' => 'nullable|array',
            'genre_ids.*' => 'exists:genres,id',
        ]);

        // Pisahkan genre_ids dari data buku
        $genreIds = $validated['genre_ids'] ?? [];
        unset($validated['genre_ids']);

        $book = Book::create($validated);

        // Attach genres jika ada
        if (!empty($genreIds)) {
            $book->genres()->attach($genreIds);
        }

        return response()->json([
            'success' => true,
            'message' => 'Book berhasil ditambahkan',
            'data' => $book->load(['author', 'genres'])
        ], 201);
    }

    /**
     * Menampilkan satu buku spesifik.
     * GET /api/books/{id}
     */
    public function show(string $id): JsonResponse
    {
        $book = Book::with(['author', 'genres'])->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'message' => 'Data book berhasil diambil',
            'data' => $book
        ]);
    }

    /**
     * Memperbarui buku yang ada di database.
     * PUT /api/books/{id}
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'isbn' => 'nullable|string|max:17|unique:books,isbn,' . $book->id,
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'pages' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'is_available' => 'nullable|boolean',
            'genre_ids' => 'nullable|array',
            'genre_ids.*' => 'exists:genres,id',
        ]);

        // Pisahkan genre_ids dari data buku
        $genreIds = $validated['genre_ids'] ?? null;
        unset($validated['genre_ids']);

        $book->update($validated);

        // Sync genres jika ada
        if ($genreIds !== null) {
            $book->genres()->sync($genreIds);
        }

        return response()->json([
            'success' => true,
            'message' => 'Book berhasil diupdate',
            'data' => $book->load(['author', 'genres'])
        ]);
    }

    /**
     * Menghapus buku dari database.
     * DELETE /api/books/{id}
     */
    public function destroy(string $id): JsonResponse
    {
        $book = Book::findOrFail($id);
        
        // Detach all genres terlebih dahulu
        $book->genres()->detach();
        
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book berhasil dihapus'
        ], 200);
    }
}