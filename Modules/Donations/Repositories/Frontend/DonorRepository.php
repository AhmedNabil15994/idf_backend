<?php

namespace Modules\Donations\Repositories\Frontend;

use Illuminate\Http\Request;
use Modules\Donations\Entities\Donor;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;
use Modules\User\Repositories\Dashboard\UserRepository;
use Illuminate\Support\Facades\Hash;

class DonorRepository
{
    private $donor;
    private $user;

    function __construct(Donor $donor , UserRepository $user)
    {
        $this->donor = $donor;
        $this->user = $user;
    }

    public function getModel()
    {
        return $this->donor;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->donor->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function count()
    {
        $nationalities = $this->donor->active()->count();
        return $nationalities;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->donor->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function findById($id)
    {
        $donor = $this->donor->withDeleted()->find($id);
        return $donor;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->user->findByEmail($request->phone);

            $request->merge([
                'status' => $request->status ? 1 : 0,
                'mobile' => $request->phone,
            ]);

            if($user){
                if($user->donor){
                    return ['status' => 0,
                        'message' => __('donations::dashboard.donors.validation.email.unique'),
                        'data' => ['email' => __('donations::dashboard.donors.validation.email.unique')]
                    ];
                }
                $user = $this->updateDonorUser($request->only('mobile','email','name','password') , $user);

            }else{
                $user = $this->createDonorUser($request->only('mobile','email','name','password'));
            }

            $user->donor()->create($request->only('status'));

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
                'name'          => $request['name'],
                'mobile'        => $request['mobile'],
                'password'      => Hash::make($request['password']),
            ]);
            return $user;

        }catch(\Exception $e){
            throw $e;
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $donor = $this->findById($id);
        $request->trash_restore ? $this->restoreSoftDelete($donor) : null;

        try {

            $request->merge([
                'status' => $request->status ? 1 : 0,
                'mobile' => $request->phone,
            ]);

            $user = $donor->user;
            $this->updateDonorUser($request->only('mobile','email','name','password') , $user);

            $donor->update($request->only('status'));

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
    public function updateDonorUser($request , $user)
    {
        try {
            if ($request['password'] == null)
                $password = $user['password'];
            else
                $password  = Hash::make($request['password']);

            $user->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'mobile'        => $request['mobile'],
                'password'      => $password,
            ]);

            return $user;

        }catch(\Exception $e){
            throw $e;
        }
    }

    public function restoreSoftDelete($model)
    {
        $model->restore();
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $model = $this->findById($id);

            if ($model->trashed()):
                $model->clearMediaCollection('images');
                $model->forceDelete();
            else:
                $model->delete();
            endif;

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function deleteSelected($request)
    {
        DB::beginTransaction();

        try {

            foreach ($request['ids'] as $id) {
                $model = $this->delete($id);
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function QueryTable($request)
    {
        $query = $this->donor->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere(function ($query) use ($request) {
                $query->whereHas('user', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search.value') . '%')
                        ->orWhere('mobile', 'like', '%' . $request->input('search.value') . '%');
                });
            });
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        // Search Countrys by Created Dates
        if (isset($request['req']['from']) && $request['req']['from'] != '')
            $query->whereDate('created_at', '>=', $request['req']['from']);

        if (isset($request['req']['to']) && $request['req']['to'] != '')
            $query->whereDate('created_at', '<=', $request['req']['to']);

        if (isset($request['req']['deleted']) && $request['req']['deleted'] == 'only')
            $query->onlyDeleted();

        if (isset($request['req']['deleted']) && $request['req']['deleted'] == 'with')
            $query->withDeleted();

        if (isset($request['req']['status']) && $request['req']['status'] == '1')
            $query->active();

        if (isset($request['req']['status']) && $request['req']['status'] == '0')
            $query->unactive();

        return $query;
    }

}
