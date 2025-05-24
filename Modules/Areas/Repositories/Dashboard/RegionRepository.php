<?php

namespace Modules\Areas\Repositories\Dashboard;

use Illuminate\Http\Request;
use Modules\Areas\Entities\Region;
use Hash;
use DB;

class RegionRepository
{
    private $region;
    function __construct(Region $region)
    {
        $this->region   = $region;
    }

    public function getModel()
    {
        return $this->region;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->region->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->region->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function findById($id)
    {
        $region = $this->region->withDeleted()->find($id);
        return $region;
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {

          $region = $this->region->create([
              'status'   => $request->status ? 1 : 0,
              'city_id'   => $request->city_id,
          ]);

          $this->translateTable($region,$request);

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

        $region = $this->findById($id);
        $request->trash_restore ? $this->restoreSoftDelete($region) : null;

        try {
            $request->merge(['status'   => $request->status ? 1 : 0]);
            $region->update($request->except('title'));

            $this->translateTable($region,$request);

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
        $query = $this->region->where(function($query) use($request){

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
        if (isset($request['req']['city_id']) && $request['req']['city_id'] != '')
            $query->where('city_id'  , $request['req']['city_id']);

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
