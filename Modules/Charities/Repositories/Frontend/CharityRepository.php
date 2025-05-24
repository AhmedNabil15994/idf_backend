<?php

namespace Modules\Charities\Repositories\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Charities\Entities\Charity;
use Modules\User\Entities\User;
use Modules\User\Repositories\Dashboard\UserRepository;

class CharityRepository
{
    private $model;
    private $user;

    function __construct(Charity $model, UserRepository $user)
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
                'mobile' => $request->phone
            ]);

            if($user){
                if($user->charity){
                    $data = [
                        'email' => __('charities::frontend.charities.validation.email.unique'),
                    ];
                    return ['status' => 0,
                        'message' => __('charities::frontend.charities.validation.email.unique'),
                        'data' => $data
                    ];
                }
                $user = $this->updateCharityUser($request->only('mobile','email','name') , $user);

            }else{
                $user = $this->createCharityUser($request->only('mobile','email','name'));
            }

            $charity = $user->charity()->create($request->only('phone','status'));
            $charity->translateOrNew(locale())->title = $request->charity_name;
            $charity->save();

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
    public function createCharityUser($request)
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
    public function updateCharityUser($request , $user)
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
