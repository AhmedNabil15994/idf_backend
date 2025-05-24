<?php

namespace Modules\Areas\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Areas\Transformers\Dashboard\CityResource;
use Modules\Core\Traits\DataTable;
use Modules\Areas\Http\Requests\Dashboard\GovernorateRequest;
use Modules\Areas\Transformers\Dashboard\GovernorateResource;
use Modules\Areas\Repositories\Dashboard\GovernorateRepository as Governorate;

class GovernorateController extends Controller
{
    private $governorate;
    private $view_path = 'areas::dashboard.governorates';

    function __construct(Governorate $governorate)
    {
        $this->governorate = $governorate;
    }

    /**
     * @param $view
     * @param array $params
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function view($view, $params = [])
    {
        return view($this->view_path . '.' . $view, $params);
    }

    public function index()
    {
        return $this->view('index');
    }

    public function getCities($id)
    {
        $records = $this->governorate->getCities($id);

        if ($records)
            return response()->json(CityResource::collection($records));
        else
            return response()->json([],400);
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->governorate->QueryTable($request));

        $datatable['data'] = GovernorateResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $governorate = $this->governorate->getModel();
        return $this->view('create', compact('governorate'));
    }

    public function store(GovernorateRequest $request)
    {
        try {
            $create = $this->governorate->create($request);

            if ($create) {
                return Response()->json([true, __('apps::dashboard.messages.created')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        return $this->view('show');
    }

    public function edit($id)
    {
        $governorate = $this->governorate->findById($id);

        return $this->view('edit', compact('governorate'));
    }

    public function update(GovernorateRequest $request, $id)
    {
        try {
            $update = $this->governorate->update($request, $id);

            if ($update) {
                return Response()->json([true, __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->governorate->delete($id);

            if ($delete) {
                return Response()->json([true, __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->governorate->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true, __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
