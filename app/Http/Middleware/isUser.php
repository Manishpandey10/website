<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'redirect_url' => route('user.login'),
                    'message' => 'You need to login first.'
                ], 401);
            }

            return redirect()->route('user.login')
                ->with('notLoggedIn', 'You need to login first to access checkout page.');
        }


        return $next($request);
    }
}
