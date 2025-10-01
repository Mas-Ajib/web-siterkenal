<?php
// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login sebagai admin
        if (!Auth::guard('admin')->check()) {
            // Jika belum login, redirect ke halaman login
            return redirect()->route('admin.login');
        }

        // Jika sudah login, lanjutkan request
        return $next($request);
    }
}