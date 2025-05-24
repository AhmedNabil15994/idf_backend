<?php

namespace Modules\Authentication\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authentication\Foundation\DonorAuthentication;
use Modules\Authentication\Http\Requests\Frontend\LoginRequest;

class LoginController extends Controller
{
    use DonorAuthentication;

    /**
     * Display a listing of the resource.
     */
    public function showLogin()
    {
        return view('authentication::frontend.auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        $errors =  $this->login($request);

        if ($errors)
            return Response()->json([false , 'errors' => $errors],400);

        return Response()->json([true ,__('authentication::frontend.login.message.login_success') ,'url' => url(route('frontend.home'))]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('frontend.home');
    }

}
