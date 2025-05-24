<?php

namespace Modules\Authentication\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Modules\Authentication\Foundation\DonorAuthentication;
use Modules\Authentication\Http\Requests\Frontend\LoginRequest;
use Modules\Authentication\Http\Requests\Frontend\RegisterRequest;
use Modules\Authentication\Notifications\Frontend\ResetPasswordNotification;
use Modules\Authentication\Repositories\Frontend\DonorRepository;

class RegisterController extends Controller
{
    use DonorAuthentication;

    private $repository;

    public function __construct()
    {
        $this->repository = new DonorRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function postRegister()
    {
        $request = App::make(RegisterRequest::class);
        try {

            $create = $this->register($request);

            if (is_array($create) && isset($create['status']) && $create['status'] == 0) {

                return Response()->json([false, 'errors' => $create['data']], 400);

            } elseif ($create) {
                return Response()->json([true, __('authentication::frontend.register.message.registered_success'), 'url' => url(route('frontend.home'))]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function register($request)
    {
        $request->merge([
            'status' => 1,
            'mobile' => $request->register_phone,
            'name' => $request->register_name,
            'phone' => $request->register_phone,
            'password' => $request->register_password,
        ]);

        $create = $this->repository->create($request);

        if (is_array($create) && isset($create['status']) && $create['status'] == 0) {

            return $create;

        } elseif ($create) {

            $request->merge([
                'email' => $request->register_phone,
            ]);
            $this->login($request);
            return $create;
        }
    }
}
