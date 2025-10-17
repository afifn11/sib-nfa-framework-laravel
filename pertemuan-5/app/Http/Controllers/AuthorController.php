<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Menampilkan semua data author.
     */
    public function index()
    {
        $authors = Author::all();
        return response()->json(['status' => 'success', 'data' => $authors]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'photo' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'messages' => $validator->errors()], 400);
        }

        $author = Author::create($request->all());
        return response()->json(['status' => 'success', 'data' => $author], 201);
    }

    /**
     * Menampilkan satu data author spesifik.
     */
    public function show(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['status' => 'error', 'message' => 'Author not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $author]);
    }

    /**
     * Memperbarui data author.
     */
    public function update(Request $request, string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['status' => 'error', 'message' => 'Author not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'photo' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'messages' => $validator->errors()], 400);
        }

        $author->update($request->all());
        return response()->json(['status' => 'success', 'data' => $author]);
    }

    /**
     * Menghapus data author.
     */
    public function destroy(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['status' => 'error', 'message' => 'Author not found'], 404);
        }

        $author->delete();
        return response()->json(['status' => 'success', 'message' => 'Author deleted successfully']);
    }
}

