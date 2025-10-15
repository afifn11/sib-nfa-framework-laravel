<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    /**
     * Menampilkan daftar semua author.
     * GET /api/authors
     */
    public function index(): JsonResponse
    {
        $authors = Author::withCount('books')->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Data authors berhasil diambil',
            'data' => $authors
        ]);
    }

    /**
     * Menyimpan author baru ke database.
     * POST /api/authors
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:authors',
            'bio' => 'nullable|string',
            'birth_date' => 'nullable|date|before:today',
            'nationality' => 'nullable|string|max:100',
        ]);

        $author = Author::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Author berhasil ditambahkan',
            'data' => $author
        ], 201);
    }

    /**
     * Menampilkan satu author spesifik dengan books-nya.
     * GET /api/authors/{id}
     */
    public function show(string $id): JsonResponse
    {
        $author = Author::with('books')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'message' => 'Data author berhasil diambil',
            'data' => $author
        ]);
    }

    /**
     * Memperbarui author yang ada di database.
     * PUT /api/authors/{id}
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $author = Author::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:authors,name,' . $author->id,
            'bio' => 'nullable|string',
            'birth_date' => 'nullable|date|before:today',
            'nationality' => 'nullable|string|max:100',
        ]);

        $author->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Author berhasil diupdate',
            'data' => $author
        ]);
    }

    /**
     * Menghapus author dari database.
     * DELETE /api/authors/{id}
     */
    public function destroy(string $id): JsonResponse
    {
        $author = Author::findOrFail($id);
        
        // Cek apakah author memiliki buku
        if ($author->books()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Author tidak dapat dihapus karena masih memiliki buku'
            ], 400);
        }
        
        $author->delete();

        return response()->json([
            'success' => true,
            'message' => 'Author berhasil dihapus'
        ], 200);
    }
}