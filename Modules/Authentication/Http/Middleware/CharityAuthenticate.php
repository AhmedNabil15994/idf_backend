<?php

namespace Modules\Authentication\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Modules\Authentication\Foundation\CharityAuthentication;

class CharityAuthenticate extends Middleware
{
    use CharityAuthentication;

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson() || !self::checkCharity()) {
            return route('charities.login');
        }
    }
}
