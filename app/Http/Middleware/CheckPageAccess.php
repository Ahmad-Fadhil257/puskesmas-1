<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPageAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->isAdmin()) {
            return $next($request);
        }

        $path = trim($request->path(), '/');
        $segments = explode('/', $path);
        $page = $segments[1] ?? '';

        $allowed = $user->getAccessiblePageKeys();

        if (!in_array($page, $allowed)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
