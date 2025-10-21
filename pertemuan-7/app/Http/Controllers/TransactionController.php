<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Menampilkan semua transaksi (Hanya untuk Admin).
     */
    public function index()
    {
        // Mengambil data transaksi beserta relasi ke customer dan book
        $transactions = Transaction::with(['customer', 'book'])->get();

        return response()->json([
            'status' => 'success',
            'data' => $transactions,
        ]);
    }

    /**
     * Membuat transaksi baru (Hanya untuk Customer).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($validated['book_id']);
        $customer = Auth::user();

        $transaction = Transaction::create([
            'order_number' => 'ORD-' . Str::uuid(),
            'customer_id' => $customer->id,
            'book_id' => $book->id,
            'total_amount' => $book->price, 
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction created successfully',
            'data' => $transaction,
        ], 201);
    }

    /**
     * Menampilkan detail transaksi (Hanya untuk Customer yang bersangkutan).
     */
    public function show(Request $request, string $id)
    {
        $transaction = Transaction::with(['customer', 'book'])->findOrFail($id);

        // Security Check: Pastikan customer hanya bisa melihat transaksinya sendiri
        // Admin juga bisa melihat ini
        if ($request->user()->role !== 'admin' && $request->user()->id !== $transaction->customer_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Forbidden. You can only view your own transactions.'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => $transaction,
        ]);
    }

    /**
     * Mengupdate transaksi (Hanya untuk Customer yang bersangkutan).
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);
        
        // Security Check: Pastikan customer hanya bisa mengupdate transaksinya sendiri
        if ($request->user()->role !== 'admin' && $request->user()->id !== $transaction->customer_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Forbidden. You can only update your own transactions.'
            ], 403);
        }

        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        $transaction->update([
            'book_id' => $book->id,
            'total_amount' => $book->price, 
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction updated successfully',
            'data' => $transaction->load(['customer', 'book']), 
        ]);
    }

    /**
     * Menghapus transaksi (Hanya untuk Admin).
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction deleted successfully',
        ]);
    }
}

