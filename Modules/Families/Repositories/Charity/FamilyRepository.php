<?php

namespace Modules\Families\Repositories\Charity;

use Illuminate\Http\Request;
use Modules\Families\Entities\Family;
use Modules\Families\Entities\FamilyMember;

class FamilyRepository
{

    public function getModel()
    {
        return auth()->user()->charity->families();
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $families = $this->getModel()->orderBy($order, $sort)->get();
        return $families;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $families = $this->getModel()->orderBy($order, $sort)->get();
        return $families;
    }

    public function findById($id)
    {
        $family = $this->getModel()->withDeleted()->findOrFail($id);
        return $family;
    }

    public function buildArray($str)
    {
        $response = [];
        $arr = explode('|', $str);
        foreach ($arr as $value) {
            $small_arr = explode(':', $value);
            $response[$small_arr[0]] = $small_arr[1];
        }
        return $response;
    }

    public function QueryTable($request)
    {
        $query = $this->getModel()->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere(function ($query) use ($request) {
                $query->whereHas('members', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search.value') . '%')
                        ->orWhere('phone', 'like', '%' . $request->input('search.value') . '%');
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
