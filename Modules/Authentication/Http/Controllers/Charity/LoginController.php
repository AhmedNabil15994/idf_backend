<?php

namespace Modules\Authentication\Http\Controllers\Charity;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authentication\Foundation\CharityAuthentication;
use Modules\Authentication\Http\Requests\Charity\LoginRequest;

class LoginController extends Controller
{
    use CharityAuthentication;

    /**
     * Display a listing of the resource.
     */
    public function showLogin()
    {
        return view('authentication::charities.auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        $errors =  $this->login($request);

        if ($errors)
            return redirect()->back()->withErrors($errors)->withInput($request->except('password'));

        return redirect()->route('charities.home');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('charities.home');
    }

}
