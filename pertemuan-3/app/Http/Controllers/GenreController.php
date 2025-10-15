<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GenreController extends Controller
{
    /**
     * Menampilkan daftar semua genre.
     * GET /api/genres
     */
    public function index(): JsonResponse
    {
        $genres = Genre::withCount('books')->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Data genres berhasil diambil',
            'data' => $genres
        ]);
    }

    /**
     * Menyimpan genre baru ke database.
     * POST /api/genres
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:genres',
            'description' => 'nullable|string',
        ]);

        $genre = Genre::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Genre berhasil ditambahkan',
            'data' => $genre
        ], 201);
    }

    /**
     * Menampilkan satu genre spesifik dengan books-nya.
     * GET /api/genres/{id}
     */
    public function show(string $id): JsonResponse
    {
        $genre = Genre::with('books.author')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'message' => 'Data genre berhasil diambil',
            'data' => $genre
        ]);
    }

    /**
     * Memperbarui genre yang ada di database.
     * PUT /api/genres/{id}
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $genre = Genre::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:genres,name,' . $genre->id,
            'description' => 'nullable|string',
        ]);

        $genre->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Genre berhasil diupdate',
            'data' => $genre
        ]);
    }

    /**
     * Menghapus genre dari database.
     * DELETE /api/genres/{id}
     */
    public function destroy(string $id): JsonResponse
    {
        $genre = Genre::findOrFail($id);
        
        // Detach all books terlebih dahulu
        $genre->books()->detach();
        
        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Genre berhasil dihapus'
        ], 200);
    }
}