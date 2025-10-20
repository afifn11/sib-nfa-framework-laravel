<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Get transaction data with customer and book relations (Eager Loading)
        $transactions = Transaction::with(['customer', 'book'])->get();

        // Return the data in JSON format
        return response()->json([
            'status' => 'success',
            'data' => $transactions
        ]);
    }
}

