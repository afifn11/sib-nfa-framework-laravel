<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Menampilkan semua data genre.
     */
    public function index()
    {
        $genres = Genre::all();
        return response()->json(['status' => 'success', 'data' => $genres]);
    }

    /**
     * Menyimpan data genre baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'messages' => $validator->errors()], 400);
        }

        $genre = Genre::create($request->all());
        return response()->json(['status' => 'success', 'data' => $genre], 201);
    }

    /**
     * Menampilkan satu data genre spesifik. (Fitur Show)
     */
    public function show(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['status' => 'error', 'message' => 'Genre not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $genre]);
    }

    /**
     * Memperbarui data genre. (Fitur Update)
     */
    public function update(Request $request, string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['status' => 'error', 'message' => 'Genre not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'messages' => $validator->errors()], 400);
        }

        $genre->update($request->all());
        return response()->json(['status' => 'success', 'data' => $genre]);
    }

    /**
     * Menghapus data genre. (Fitur Destroy)
     */
    public function destroy(string $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['status' => 'error', 'message' => 'Genre not found'], 404);
        }

        $genre->delete();
        return response()->json(['status' => 'success', 'message' => 'Genre deleted successfully']);
    }
}

