<?php
// app/Http/Middleware/SuperAdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        if (!auth()->guard('admin')->user()->isSuperadmin()) {
            abort(403, 'Unauthorized action. Hanya Super Admin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}