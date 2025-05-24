<?php

namespace Modules\Catalog\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Catalog\Http\Requests\Dashboard\ReligionRequest;
use Modules\Catalog\Transformers\Dashboard\ReligionResource;
use Modules\Catalog\Repositories\Dashboard\ReligionRepository as Religion;

class ReligionController extends Controller
{
    private $religion;

    function __construct(Religion $religion)
    {
        $this->religion = $religion;
    }

    public function index()
    {
        return view('catalog::dashboard.religions.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->religion->QueryTable($request));

        $datatable['data'] = ReligionResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $religion = $this->religion->getModel();
        return view('catalog::dashboard.religions.create',compact('religion'));
    }

    public function store(ReligionRequest $request)
    {
        try {
            $create = $this->religion->create($request);

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
        return view('catalog::dashboard.religions.show');
    }

    public function edit($id)
    {
        $religion = $this->religion->findById($id);

        return view('catalog::dashboard.religions.edit',compact('religion'));
    }

    public function update(ReligionRequest $request, $id)
    {
        try {
            $update = $this->religion->update($request,$id);

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
            $delete = $this->religion->delete($id);

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
            $deleteSelected = $this->religion->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
