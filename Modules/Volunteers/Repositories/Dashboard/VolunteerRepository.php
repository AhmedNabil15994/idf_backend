<?php

namespace Modules\Volunteers\Repositories\Dashboard;

use Illuminate\Http\Request;
use Modules\Volunteers\Entities\Volunteer;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;
use Modules\User\Repositories\Dashboard\UserRepository;
use Illuminate\Support\Facades\Hash;

class VolunteerRepository
{
    private $volunteer;
    private $user;

    function __construct(Volunteer $volunteer , UserRepository $user)
    {
        $this->volunteer = $volunteer;
        $this->user = $user;
    }

    public function getModel()
    {
        return $this->volunteer;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->volunteer->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->volunteer->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function findById($id)
    {
        $volunteer = $this->volunteer->withDeleted()->find($id);
        return $volunteer;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->user->findByEmail($request->phone);

            $request->merge([
                'status' => $request->status ? 1 : 0,
                'mobile' => $request->phone
            ]);

            if($user){
                if($user->volunteer){
                    return ['status' => 0,
                        'message' => __('volunteers::dashboard.volunteers.validation.email.unique'),
                        'data' => ['email' => __('volunteers::dashboard.volunteers.validation.email.unique')]
                    ];
                }
                $user = $this->updateVolunteerUser($request->only('mobile','email','name','password') , $user);

            }else{
                $user = $this->createVolunteerUser($request->only('mobile','email','name','password'));
            }

            $volunteer = $user->volunteer()->create($request->only('status','charity_id'));

            if ($request->hasFile('image')) {
                $volunteer->addMediaFromRequest('image')->toMediaCollection('images');
            }

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

        $volunteer = $this->findById($id);
        $request->trash_restore ? $this->restoreSoftDelete($volunteer) : null;

        try {

            $request->merge([
                'status' => $request->status ? 1 : 0,
                'mobile' => $request->phone
            ]);

            $user = $volunteer->user;
            $this->updateVolunteerUser($request->only('mobile','email','name','password') , $user);

            $volunteer->update($request->only('status','charity_id'));

            if ($request->hasFile('image')) {
                $volunteer->clearMediaCollection('images');
                $volunteer->addMediaFromRequest('image')->toMediaCollection('images');
            }

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
    public function updateVolunteerUser($request , $user)
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
        $query = $this->volunteer->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere(function ($query) use ($request) {
                $query->whereHas('user', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search.value') . '%')
                        ->orWhere('email', 'like', '%' . $request->input('search.value') . '%');
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
