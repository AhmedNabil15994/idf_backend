<?php

namespace Modules\Donations\Repositories\Frontend;

use Illuminate\Http\Request;
use Modules\Donations\Entities\DonateResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DonateResourceRepository
{
    private $donate_resource;

    function __construct(DonateResource $donate_resource)
    {
        $this->donate_resource = $donate_resource;
    }

    public function getModel()
    {
        return $this->donate_resource;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
       return  $this->donate_resource->active()->orderBy($order, $sort)->get();
    }

    public function findById($id)
    {
        $donate_resource = $this->donate_resource->active()->find($id);
        return $donate_resource;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {

            $model = $this->donate_resource->create($request->only('name','phone'));

            foreach ($request->item_types as $key => $item){
                $model->items()->create([
                    'categories' => $request->categories[$key],
                    'quantity' => $request->quantities[$key],
                    'item_type_id' => $item,
                ]);
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function translateTable($model, $request)
    {
        foreach ($request['title'] as $locale => $value) {
            $model->translateOrNew($locale)->title = $value;
        }

        $model->save();
    }
}
