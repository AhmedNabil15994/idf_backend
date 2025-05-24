<?php

namespace Modules\Volunteers\Repositories\Charity;

use Illuminate\Http\Request;
use Modules\Volunteers\Entities\Volunteer;

class VolunteerRepository
{

    public function getModel()
    {
        return auth()->user()->charity->volunteers();
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->getModel()->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->getModel()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function findById($id)
    {
        $volunteer = $this->getModel()->withDeleted()->find($id);
        return $volunteer;
    }

    public function QueryTable($request)
    {
        $query = $this->getModel()->where(function ($query) use ($request) {
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
