<?php

namespace Modules\Charities\Repositories\Dashboard;

use Illuminate\Http\Request;
use Modules\Charities\Entities\Charity;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;
use Modules\User\Repositories\Dashboard\UserRepository;
use Illuminate\Support\Facades\Hash;

class CharityRepository
{
    private $charity;
    private $user;

    function __construct(Charity $charity , UserRepository $user)
    {
        $this->charity = $charity;
        $this->user = $user;
    }

    public function getModel()
    {
        return $this->charity;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->charity->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->charity->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function findById($id)
    {
        $charity = $this->charity->withDeleted()->find($id);
        return $charity;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->user->findByEmail($request->phone);

            $request->merge([
                'status' => $request->status ? 1 : 0,
                'mobile' => $request->phone,
                'name' => $request->title[locale()]
            ]);

            if($user){
                if($user->charity){
                    return ['status' => 0,
                        'message' => __('charities::dashboard.charities.validation.email.unique'),
                        'data' => ['email' => __('charities::dashboard.charities.validation.email.unique')]
                    ];
                }
                $user = $this->updateCharityUser($request->only('mobile','email','name','password') , $user);

            }else{
                $user = $this->createCharityUser($request->only('mobile','email','name','password'));
            }

            $charity = $user->charity()->create($request->only('status','address','phone','whats_app','facebook'));
            $this->translateTable($charity, $request);

            if ($request->hasFile('logo')) {
                $charity->addMediaFromRequest('logo')->toMediaCollection('images');
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
    public function createCharityUser($request)
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

        $charity = $this->findById($id);
        $request->trash_restore ? $this->restoreSoftDelete($charity) : null;

        try {

            $request->merge([
                'status' => $request->status ? 1 : 0,
                'mobile' => $request->phone,
                'name' => $request->title[locale()]
            ]);

            $user = $charity->user;
            $this->updateCharityUser($request->only('mobile','email','name','password') , $user);

            $charity->update($request->only('status','address','phone','whats_app','facebook'));
            $this->translateTable($charity, $request);

            if ($request->hasFile('logo')) {
                $charity->clearMediaCollection('images');
                $charity->addMediaFromRequest('logo')->toMediaCollection('images');
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
    public function updateCharityUser($request , $user)
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

    public function translateTable($model, $request)
    {
        foreach ($request['title'] as $locale => $value) {
            $model->translateOrNew($locale)->title = $value;
            $model->translateOrNew($locale)->description = $request['description'] ? $request['description'][$locale] : null;
        }

        $model->save();
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
        $query = $this->charity->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere(function ($query) use ($request) {
                $query->whereHas('translations', function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->input('search.value') . '%')
                        ->orWhere('description', 'like', '%' . $request->input('search.value') . '%');
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
