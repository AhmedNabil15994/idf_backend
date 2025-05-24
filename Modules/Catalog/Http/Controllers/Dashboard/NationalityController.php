<?php

namespace Modules\Catalog\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Catalog\Http\Requests\Dashboard\NationalityRequest;
use Modules\Catalog\Transformers\Dashboard\NationalityResource;
use Modules\Catalog\Repositories\Dashboard\NationalityRepository as Nationality;

class NationalityController extends Controller
{
    private $nationality;

    function __construct(Nationality $nationality)
    {
        $this->nationality = $nationality;
    }

    public function index()
    {
        return view('catalog::dashboard.nationalities.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->nationality->QueryTable($request));

        $datatable['data'] = NationalityResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $nationality = $this->nationality->getModel();
        return view('catalog::dashboard.nationalities.create',compact('nationality'));
    }

    public function store(NationalityRequest $request)
    {
        try {
            $create = $this->nationality->create($request);

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
        return view('catalog::dashboard.nationalities.show');
    }

    public function edit($id)
    {
        $nationality = $this->nationality->findById($id);

        return view('catalog::dashboard.nationalities.edit',compact('nationality'));
    }

    public function update(NationalityRequest $request, $id)
    {
        try {
            $update = $this->nationality->update($request,$id);

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
            $delete = $this->nationality->delete($id);

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
            $deleteSelected = $this->nationality->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
