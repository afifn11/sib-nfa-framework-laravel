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

// Author Routes
Route::get('/authors', [AuthorController::class, 'index']); // Read all
Route::post('/authors', [AuthorController::class, 'store']); // Create

// Book Routes
Route::get('/books', [BookController::class, 'index']);

// Genre Routes
Route::get('/genres', [GenreController::class, 'index']); // Read all
Route::post('/genres', [GenreController::class, 'store']); // Create

// Transaction Routes
Route::get('/transactions', [TransactionController::class, 'index']);

