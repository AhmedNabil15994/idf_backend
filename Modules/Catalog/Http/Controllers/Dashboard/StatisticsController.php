<?php

namespace Modules\Catalog\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Catalog\Repositories\Dashboard\StatisticsRepository;
use Modules\Core\Traits\DataTable;
use Modules\Catalog\Http\Requests\Dashboard\StatisticsRequest;
use Modules\Catalog\Transformers\Dashboard\StatisticsResource;

class StatisticsController extends Controller
{
    private $statistics;

    function __construct(StatisticsRepository $statistics)
    {
        $this->statistics = $statistics;
    }

    public function index()
    {
        return view('catalog::dashboard.statistics.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->statistics->QueryTable($request));

        $datatable['data'] = StatisticsResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $statistics = $this->statistics->getModel();
        return view('catalog::dashboard.statistics.create',compact('statistics'));
    }

    public function store(StatisticsRequest $request)
    {
        try {
            $create = $this->statistics->create($request);

            if ($create) {
                return Response()->json([true , __('apps::dashboard.messages.created')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        return view('catalog::dashboard.statistics.show');
    }

    public function edit($id)
    {
        $statistics = $this->statistics->findById($id);

        return view('catalog::dashboard.statistics.edit',compact('statistics'));
    }

    public function update(StatisticsRequest $request, $id)
    {
        try {
            $update = $this->statistics->update($request,$id);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->statistics->delete($id);

            if ($delete) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->statistics->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
