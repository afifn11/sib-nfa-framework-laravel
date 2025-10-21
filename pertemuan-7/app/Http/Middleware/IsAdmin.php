<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN perannya adalah 'admin'
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request); 
        }

        // Jika tidak, kirim response error
        return response()->json([
            'status' => 'error',
            'message' => 'Forbidden: You must be an admin to perform this action.'
        ], 403); 
    }
}