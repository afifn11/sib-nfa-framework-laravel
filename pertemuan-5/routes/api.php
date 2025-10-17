<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route authors
Route::apiResource('authors', AuthorController::class);

// Route genres
Route::apiResource('genres', GenreController::class);


// Route di bawah ini tetap sama karena tidak termasuk dalam tugas
Route::get('/books', [BookController::class, 'index']);
Route::get('/transactions', [TransactionController::class, 'index']);

