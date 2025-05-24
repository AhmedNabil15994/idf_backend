<?php

namespace Modules\Areas\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Areas\Transformers\Dashboard\RegionResource;
use Modules\Core\Traits\DataTable;
use Modules\Areas\Http\Requests\Dashboard\CityRequest;
use Modules\Areas\Transformers\Dashboard\CityResource;
use Modules\Areas\Repositories\Dashboard\CityRepository as City;

class CityController extends Controller
{
    private $city;
    private $view_path = 'areas::dashboard.cities';

    function __construct(City $city)
    {
        $this->city = $city;
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
        $datatable = DataTable::drawTable($request, $this->city->QueryTable($request));

        $datatable['data'] = CityResource::collection($datatable['data']);

        return Response()->json($datatable);
    }


    public function getRegions($id)
    {
        $records = $this->city->getRegions($id);

        if ($records)
            return response()->json(RegionResource::collection($records));
        else
            return response()->json([],400);
    }

    public function create()
    {
        $city = $this->city->getModel();
        return $this->view('create',compact('city'));
    }

    public function store(CityRequest $request)
    {
        try {
            $create = $this->city->create($request);

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
        $city = $this->city->findById($id);

        return $this->view('edit',compact('city'));
    }

    public function update(CityRequest $request, $id)
    {
        try {
            $update = $this->city->update($request,$id);

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
            $delete = $this->city->delete($id);

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
            $deleteSelected = $this->city->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
