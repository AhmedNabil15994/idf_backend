<?php

namespace Modules\Authentication\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Authentication\Foundation\DonorAuthentication;

class DonorGuestAuthentication
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
        if (!self::checkGuest()) {
            return redirect()->route('frontend.home');
        }
        return $next($request);
    }
}
