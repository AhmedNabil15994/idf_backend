<?php

namespace App\Http\Middleware;

use App\myHelper\helper;
use Closure;
use Illuminate\Support\Facades\Auth;
use Modules\Authentication\Foundation\CharityAuthentication;

class CharityActiveCheck
{
    use CharityAuthentication;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!self::checkCharity()) {
            return redirect()->route('charities.login');
        }

        return $next($request);
    }
}
