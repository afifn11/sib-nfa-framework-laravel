<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Get all genre data
        $genres = Genre::all();

        // Return the data in JSON format
        return response()->json([
            'status' => 'success',
            'data' => $genres
        ]);
    }
}

