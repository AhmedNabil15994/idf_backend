<?php

namespace Modules\Volunteers\Repositories\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\User\Entities\User;
use Modules\User\Repositories\Dashboard\UserRepository;
use Modules\Volunteers\Entities\Volunteer;

class VolunteerRepository
{
    private $model;
    private $user;

    function __construct(Volunteer $model, UserRepository $user)
    {
        $this->model = $model;
        $this->user = $user;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->model->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function take( $take = 6,$order = 'id', $sort = 'desc')
    {
        $nationalities = $this->model->active()->orderBy($order, $sort)->take($take)->get();
        return $nationalities;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->model->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function getPagination($order = 'id', $sort = 'desc' , $pagination = 10)
    {
        $nationalities = $this->model->active()->orderBy($order, $sort)->paginate($pagination);
        return $nationalities;
    }

    public function findById($id)
    {
        $model = $this->model->active()->find($id);
        return $model;
    }


    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->user->findByEmail($request->phone);

            $request->merge([
                'status' =>  0,
                'mobile' => $request->phone,
                'd_o_b' => Carbon::parse($request->d_o_b)->toDateString(),
            ]);

            if($user){
                if($user->volunteer){
                    return ['status' => 0,
                        'message' => __('volunteers::dashboard.volunteers.validation.email.unique'),
                        'data' => ['email' => __('volunteers::dashboard.volunteers.validation.email.unique')]
                    ];
                }
                $user = $this->updateVolunteerUser($request->only('mobile','email','name') , $user);

            }else{
                $user = $this->createVolunteerUser($request->only('mobile','email','name'));
            }

            $user->volunteer()->create($request->only('phone','status','d_o_b'));

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
    public function createVolunteerUser($request)
    {
        try {
            $user = User::create([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'mobile'        => $request['mobile'],
                'password'      => Hash::make(Str::random(10)),
            ]);
            return $user;

        }catch(\Exception $e){
            throw $e;
        }
    }

    /*
    * Create New Object & Insert to DB
    */
    public function updateVolunteerUser($request , $user)
    {
        try {
            $user->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'mobile'        => $request['mobile'],
            ]);

            return $user;

        }catch(\Exception $e){
            throw $e;
        }
    }
}
