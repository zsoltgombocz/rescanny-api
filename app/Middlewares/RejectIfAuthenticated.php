<?php

namespace App\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RejectIfAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('web')->check()) {
            return response()->json(null, Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
