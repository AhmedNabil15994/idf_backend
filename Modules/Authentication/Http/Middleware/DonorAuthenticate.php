<?php

namespace Modules\Authentication\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Authentication\Foundation\DonorAuthentication;

class DonorAuthenticate
{
    use DonorAuthentication;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!self::checkDonor()) {
            return redirect()->route('frontend.auth.login');
        }

        return $next($request);
    }
}
