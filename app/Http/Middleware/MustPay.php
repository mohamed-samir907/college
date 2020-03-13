<?php

namespace App\Http\Middleware;

use Closure;

class MustPay
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (!$user->payment_verified) {
            abort(401, "unauthorized");
        }

        return $next($request);
    }
}
