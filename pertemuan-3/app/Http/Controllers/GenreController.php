<?php

namespace App\Http\Controllers;

use App\Models\Genre;
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
}