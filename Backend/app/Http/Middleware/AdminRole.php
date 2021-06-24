<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;


class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->isAdmin) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized'.$user], 410);

    }
}
