<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Endpoint untuk login (publik)
Route::post('/login', [AuthController::class, 'login']);

// --- ROUTES PUBLIK ---
// Author & Genre dapat dibaca oleh semua orang
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{id}', [GenreController::class, 'show']);

// Books dapat dibaca oleh semua orang
Route::get('/books', [BookController::class, 'index']);


// --- ROUTES MIDDLEWARE UNTUK ADMIN ---
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // CRUD Author
    Route::post('/authors', [AuthorController::class, 'store']);
    Route::put('/authors/{id}', [AuthorController::class, 'update']);
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);

    // CRUD Genre
    Route::post('/genres', [GenreController::class, 'store']);
    Route::put('/genres/{id}', [GenreController::class, 'update']);
    Route::delete('/genres/{id}', [GenreController::class, 'destroy']);
    
    // Read All & Destroy Transactions
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);
});


// --- ROUTES MIDDLEWARE UNTUK CUSTOMER ---
// Semua pengguna yang sudah login (termasuk customer) bisa mengakses ini
Route::middleware(['auth:sanctum'])->group(function () {
    // Create, Show, Update Transactions
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::get('/transactions/{id}', [TransactionController::class, 'show']);
    Route::put('/transactions/{id}', [TransactionController::class, 'update']);
});