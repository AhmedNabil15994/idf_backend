<?php

namespace Modules\Areas\Repositories\Dashboard;

use Illuminate\Http\Request;
use Modules\Areas\Entities\City;
use Hash;
use DB;

class CityRepository
{
    private $city;
    function __construct(City $city)
    {
        $this->city   = $city;
    }

    public function getModel()
    {
        return $this->city;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->city->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->city->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function getRegions($id)
    {
        $city = $this->findById($id);

        if(!$city)
            return false;

        $regions = $city->regions()->get();
        return $regions;
    }

    public function findById($id)
    {
        $city = $this->city->withDeleted()->find($id);
        return $city;
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {

          $city = $this->city->create([
              'status'   => $request->status ? 1 : 0,
              'governorate_id'   => $request->governorate_id,
          ]);

          $this->translateTable($city,$request);

          DB::commit();
          return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function update(Request $request,$id)
    {
        DB::beginTransaction();

        $city = $this->findById($id);
        $request->trash_restore ? $this->restoreSoftDelete($city) : null;

        try {
            $request->merge(['status'   => $request->status ? 1 : 0]);
            $city->update($request->except('title'));

            $this->translateTable($city,$request);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function restoreSoftDelete($model)
    {
        $model->restore();
    }

    public function translateTable($model,$request)
    {
        foreach ($request['title'] as $locale => $value) {
            $model->translateOrNew($locale)->title           = $value;
        }

        $model->save();
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $model = $this->findById($id);

            if ($model->trashed()):
              $model->forceDelete();
            else:
              $model->delete();
            endif;

            DB::commit();
            return true;

        }catch(\Exception $e){
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

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function QueryTable($request)
    {
        $query = $this->city->where(function($query) use($request){

                      $query->where('id', 'like' , '%'. $request->input('search.value') .'%');
                      $query->orWhere( function( $query ) use($request){
                          $query->whereHas('translations', function($query) use($request) {
                              $query->where('title'        , 'like' , '%'. $request->input('search.value') .'%');
                          });
                      });
                });

        $query = $this->filterDataTable($query,$request);

        return $query;
    }

    public function filterDataTable($query,$request)
    {
        // Search Cities by Created Dates
        if (isset($request['req']['governorate_id']) && $request['req']['governorate_id'] != '')
            $query->where('governorate_id'  , $request['req']['governorate_id']);

        if (isset($request['req']['from']) && $request['req']['from'] != '')
            $query->whereDate('created_at'  , '>=' , $request['req']['from']);

        if (isset($request['req']['to']) && $request['req']['to'] != '')
            $query->whereDate('created_at'  , '<=' , $request['req']['to']);

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'only')
            $query->onlyDeleted();

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'with')
            $query->withDeleted();

        if (isset($request['req']['status']) &&  $request['req']['status'] == '1')
            $query->active();

        if (isset($request['req']['status']) &&  $request['req']['status'] == '0')
            $query->unactive();

        return $query;
    }

}
