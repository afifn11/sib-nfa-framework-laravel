<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Get all author data from the database
        $authors = Author::all();

        // Return the data in JSON format
        return response()->json([
            'status' => 'success',
            'data' => $authors
        ]);
    }
}

