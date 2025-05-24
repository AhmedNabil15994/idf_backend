<?php

namespace Modules\Baskets\Repositories\Dashboard;

use Illuminate\Http\Request;
use Modules\Baskets\Entities\FoodBasket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class BasketRepository
{
    private $basket;

    function __construct(FoodBasket $basket)
    {
        $this->basket = $basket;
    }

    public function getModel()
    {
        return $this->basket;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->basket->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->basket->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function findById($id)
    {
        $basket = $this->basket->withDeleted()->find($id);
        return $basket;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->merge(['status' => $request->status ? 1 : 0]);
            $basket = $this->basket->create($request->except('title', 'description'));
            $this->translateTable($basket, $request);

            if ($request->file('image')) {
                $basket->addMediaFromRequest('image')->toMediaCollection('images');
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $basket = $this->findById($id);
        $request->trash_restore ? $this->restoreSoftDelete($basket) : null;

        try {

            $request->merge(['status' => $request->status ? 1 : 0]);
            $basket->update($request->except('title', 'description'));
            $this->translateTable($basket, $request);

            if ($request->file('image')) {
                $basket->clearMediaCollection('images');
                $basket->addMediaFromRequest('image')->toMediaCollection('images');
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
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
        $query = $this->basket->where(function ($query) use ($request) {
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
