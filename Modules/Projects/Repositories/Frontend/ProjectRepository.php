<?php

namespace Modules\Projects\Repositories\Frontend;

use Illuminate\Http\Request;
use Modules\Projects\Entities\Project;
use Illuminate\Support\Facades\DB;

class ProjectRepository
{
    private $project;

    function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function getModel()
    {
        return $this->project;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $records = $this->project->active()->orderBy($order, $sort)->get();
        return $records;
    }

    public function take(Request $request, $take = 6, $order = 'id', $sort = 'desc')
    {
        $records = $this->project->active()->where(function ($q) use ($request) {
            if ($request->categories && count($request->categories))
                $q->whereHas('categories', function ($q) use ($request) {
                    $q->whereIn('categories.id', (array)$request->categories);
                });

        })->orderBy($order, $sort)->take($take)->get();
        return $records;
    }

    public function takeLike(Request $request, $ignore_id ,$take = 3, $order = 'id', $sort = 'desc')
    {
        $records = $this->project->active()->where('id' , '!=' , $ignore_id)->where(function ($q) use ($request) {
                $q->whereHas('categories', function ($q) use ($request) {
                    $q->whereIn('categories.id', (array)$request->categories);
                });

        })->orderBy($order, $sort)->take($take)->get();
        return $records;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $records = $this->project->active()->orderBy($order, $sort)->get();
        return $records;
    }

    public function getPagination(Request $request, $order = 'id', $sort = 'desc', $pagination = 10)
    {
        $records = $this->project->active()->where(function ($query) use ($request) {
            if ($request->category && count($request->category)) {
                foreach ($request->category as $parent => $child) {
                    $query->where(function ($q) use ($parent, $child) {
                        $q->whereHas('categories', function ($q) use ($parent, $child) {
                            $q->where('categories.id', $child);
                            $q->whereNotNull('categories.category_id');
                            $q->where('categories.category_id', $parent);
                        });
                    });
                }
            }
        })->orderBy($order, $sort)->paginate($pagination);
        return $records;
    }

    public function findById($id)
    {
        $project = $this->project->active()->find($id);
        return $project;
    }

    public function findBySlug($slug)
    {
        $project = $this->project->active()->whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->firstOrFail();

        return $project;
    }

    public function QueryTable($request)
    {
        $query = $this->project->where(function ($query) use ($request) {
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
