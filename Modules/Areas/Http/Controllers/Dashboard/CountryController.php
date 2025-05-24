<?php

namespace Modules\Areas\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Areas\Http\Requests\Dashboard\CountryRequest;
use Modules\Areas\Transformers\Dashboard\CountryResource;
use Modules\Areas\Repositories\Dashboard\CountryRepository as Country;

class CountryController extends Controller
{
    private $country;
    private $view_path = 'areas::dashboard.countries';

    function __construct(Country $country)
    {
        $this->country = $country;
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
        $datatable = DataTable::drawTable($request, $this->country->QueryTable($request));

        $datatable['data'] = CountryResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $country = $this->country->getModel();
        return $this->view('create',compact('country'));
    }

    public function store(CountryRequest $request)
    {
        try {
            $create = $this->country->create($request);

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
        $country = $this->country->findById($id);

        return $this->view('edit',compact('country'));
    }

    public function update(CountryRequest $request, $id)
    {
        try {
            $update = $this->country->update($request,$id);

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
            $delete = $this->country->delete($id);

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
            $deleteSelected = $this->country->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
