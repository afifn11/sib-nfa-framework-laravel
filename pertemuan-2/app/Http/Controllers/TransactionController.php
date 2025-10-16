<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // Eager load relasi customer dan book
        $transactions = Transaction::with(['customer', 'book'])->get();
        return view('transactions.index', compact('transactions'));
    }
}
