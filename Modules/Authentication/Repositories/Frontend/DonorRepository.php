<?php

namespace Modules\Authentication\Repositories\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Donations\Entities\Donor;
use Modules\User\Entities\PasswordReset;
use Modules\User\Entities\User;
use Modules\User\Repositories\Dashboard\UserRepository;
use Modules\Volunteers\Entities\Volunteer;

class DonorRepository
{
    private $model;
    private $user;
    private $password;
    private $userModel;

    function __construct()
    {
        $this->password = new PasswordReset;
        $this->model = new Donor;
        $this->user = new UserRepository;
        $this->userModel = new User();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        return $this->model->active()->orderBy($order, $sort)->get();
    }

    public function take($take = 6, $order = 'id', $sort = 'desc')
    {
        return $this->model->active()->orderBy($order, $sort)->take($take)->get();
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        return $this->model->active()->orderBy($order, $sort)->get();
    }

    public function getPagination($order = 'id', $sort = 'desc', $pagination = 10)
    {
        return $this->model->active()->orderBy($order, $sort)->paginate($pagination);
    }

    public function findById($id)
    {
        return $this->model->active()->find($id);
    }


    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->user->findByEmail($request->mobile);

            if ($user) {
                if ($user->donor) {
                    return ['status' => 0,
                        'message' => __('volunteers::dashboard.volunteers.validation.email.unique'),
                        'data' => ['register_email' => __('volunteers::dashboard.volunteers.validation.email.unique')]
                    ];
                }
                $user = $this->updateDonorUser($request->only('mobile', 'email', 'name','password'), $user);

            } else {
                $user = $this->createDonorUser($request->only('mobile', 'email', 'name','password'));
            }

            $user->donor()->create($request->only('phone', 'status', 'd_o_b'));

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /*
       * Create New Object & Insert to DB
       */
    public function createDonorUser($request)
    {
        try {
            $user = User::create([
                'name' => $request['name'],
                'mobile' => $request['mobile'],
                'password' => Hash::make($request['password']),
            ]);
            return $user;

        } catch (\Exception $e) {
            throw $e;
        }
    }

    /*
    * Create New Object & Insert to DB
    */
    public function updateDonorUser($request, $user)
    {
        try {
            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'password' => Hash::make($request['password']),
            ]);

            return $user;

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function createToken($request)
    {
        $user = $this->findUserByEmail($request);

        $this->deleteTokens($user);

        $newToken = strtolower(Str::random(64));

        $token = $this->password->insert([
            'email' => $user->email,
            'token' => $newToken,
            'created_at' => Carbon::now(),
        ]);

        $data = [
            'token' => $newToken,
            'user' => $user,
        ];

        return $data;
    }


    public function findUserByEmail($request)
    {
        return $this->userModel->where('email', $request->email)->first();
    }

    public function resetPassword($request)
    {
        $user = $this->findUserByEmail($request);

        $user->password = Hash::make($request->password);
        $user->save();

        $this->deleteTokens($user);

        return true;
    }

    public function deleteTokens($user)
    {
        $this->password->where('email', $user->email)->delete();
    }
}
