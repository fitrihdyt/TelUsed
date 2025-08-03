<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->level === 'admin') {
            \Log::info('=== AdminMiddleware DILALUI ===');
            return $next($request);
        }

        \Log::warning('=== AdminMiddleware DITOLAK ===', ['user' => auth()->user()]);

        return abort(403, 'Akses khusus admin.');
    }
}
