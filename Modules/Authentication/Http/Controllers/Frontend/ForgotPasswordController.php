<?php

namespace Modules\Authentication\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authentication\Http\Requests\Frontend\ForgetPasswordRequest;
use Modules\Authentication\Notifications\Frontend\ResetPasswordNotification;
use Modules\Authentication\Repositories\Frontend\DonorRepository as Authentication;

class ForgotPasswordController extends Controller
{
    function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function forgetPassword()
    {
        return view('authentication::frontend.auth.passwords.email');
    }


    public function sendForgetPassword(ForgetPasswordRequest $request)
    {
        $token = $this->auth->createToken($request);

        $token['user']->notify((new ResetPasswordNotification($token))->locale(locale()));

        return Response()->json([true ,__('authentication::api.forget_password.messages.success') ,'url' => url(route('frontend.home'))]);
    }
}
