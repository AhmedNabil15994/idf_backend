<?php

namespace Modules\Areas\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Areas\Http\Requests\Dashboard\RegionRequest;
use Modules\Areas\Transformers\Dashboard\RegionResource;
use Modules\Areas\Repositories\Dashboard\RegionRepository as Region;

class RegionController extends Controller
{
    private $region;
    private $view_path = 'areas::dashboard.regions';

    function __construct(Region $region)
    {
        $this->region = $region;
    }

    /**
     * @param $view
     * @param array $params
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function view($view , $params = [])
    {
        return view($this->view_path  .'.'. $view, $params);
    }

    public function index()
    {
        return $this->view('index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->region->QueryTable($request));

        $datatable['data'] = RegionResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $region = $this->region->getModel();
        return $this->view('create',compact('region'));
    }

    public function store(RegionRequest $request)
    {
        try {
            $create = $this->region->create($request);

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
        return $this->view('show');
    }

    public function edit($id)
    {
        $region = $this->region->findById($id);

        return $this->view('edit',compact('region'));
    }

    public function update(RegionRequest $request, $id)
    {
        try {
            $update = $this->region->update($request,$id);

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
            $delete = $this->region->delete($id);

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
            $deleteSelected = $this->region->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
