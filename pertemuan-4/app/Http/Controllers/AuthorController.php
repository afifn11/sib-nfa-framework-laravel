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
        $authors = Author::all();
        
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
}