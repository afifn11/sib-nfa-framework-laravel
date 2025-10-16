<?php

namespace App\Http\Controllers;

use App\Models\Author;
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
}