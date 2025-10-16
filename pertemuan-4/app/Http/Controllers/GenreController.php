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
        $genres = Genre::all();
        
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
}