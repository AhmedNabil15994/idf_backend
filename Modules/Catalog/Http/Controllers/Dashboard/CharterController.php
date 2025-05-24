<?php

namespace Modules\Catalog\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Catalog\Repositories\Dashboard\CharterRepository;
use Modules\Catalog\Transformers\Dashboard\CharterResource;
use Modules\Core\Traits\DataTable;
use Modules\Catalog\Http\Requests\Dashboard\StatisticsRequest;

class CharterController extends Controller
{
    private $repository;

    function __construct(CharterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('catalog::dashboard.charters.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->repository->QueryTable($request));

        $datatable['data'] = CharterResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $model = $this->repository->getModel();
        return view('catalog::dashboard.charters.create',compact('model'));
    }

    public function store(StatisticsRequest $request)
    {
        try {
            $create = $this->repository->create($request);

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
        return view('catalog::dashboard.charters.show');
    }

    public function edit($id)
    {
        $model = $this->repository->findById($id);

        return view('catalog::dashboard.charters.edit',compact('model'));
    }

    public function update(StatisticsRequest $request, $id)
    {
        try {
            $update = $this->repository->update($request,$id);

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
            $delete = $this->repository->delete($id);

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
            $deleteSelected = $this->repository->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
