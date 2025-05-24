<?php

namespace Modules\Authentication\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Authentication\Foundation\Authentication;
use Modules\Authentication\Foundation\DonorAuthentication;

class DashboardAuthenticate
{
    use Authentication;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        if (!self::checkAdmin()) {
        if (!auth()->check()) {
            return redirect()->route('dashboard.login');
        }

        return $next($request);
    }
}
