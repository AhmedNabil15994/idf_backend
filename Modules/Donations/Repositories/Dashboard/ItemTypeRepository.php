<?php

namespace Modules\Donations\Repositories\Dashboard;

use Modules\Donations\Entities\ItemType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ItemTypeRepository
{
    private $item_type;
    function __construct(ItemType $item_type)
    {
        $this->item_type   = $item_type;
    }

    public function getModel()
    {
        return $this->item_type;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->item_type->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->item_type->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function findById($id)
    {
        $item_type = $this->item_type->withDeleted()->find($id);
        return $item_type;
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {

          $item_type = $this->item_type->create([
              'status'   => $request->status ? 1 : 0,
          ]);

          $this->translateTable($item_type,$request);

          DB::commit();
          return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function update($request,$id)
    {
        DB::beginTransaction();

        $item_type = $this->findById($id);
        $request->trash_restore ? $this->restoreSoftDelte($item_type) : null;

        try {

            $item_type->update([
                'status'   => $request->status ? 1 : 0,
            ]);

            $this->translateTable($item_type,$request);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function restoreSoftDelte($model)
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
        $query = $this->item_type->where(function($query) use($request){
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
        // Search ItemTypes by Created Dates
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
