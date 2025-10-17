<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Menampilkan daftar semua genre. (Fitur Read All)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $genres = Genre::all();
        return response()->json([
            'status' => 'success',
            'data' => $genres
        ]);
    }

    /**
     * Menyimpan genre baru ke database. (Fitur Create)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validasi input dari user
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Jika validasi gagal, kembalikan response error
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'messages' => $validator->errors()
            ], 400);
        }

        // Buat genre baru
        $genre = Genre::create($request->all());

        // Kembalikan response sukses beserta data yang baru dibuat
        return response()->json([
            'status' => 'success',
            'data' => $genre
        ], 201); // 201 Created
    }
}

