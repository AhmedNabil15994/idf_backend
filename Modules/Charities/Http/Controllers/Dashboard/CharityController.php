<?php

namespace Modules\Charities\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Charities\Http\Requests\Dashboard\CharityRequest;
use Modules\Charities\Transformers\Dashboard\CharityResource;
use Modules\Charities\Repositories\Dashboard\CharityRepository as Charity;

class CharityController extends Controller
{
    private $charity;
    private $view_path = 'charities::dashboard.charities';

    function __construct(Charity $charity)
    {
        $this->charity = $charity;
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
        $datatable = DataTable::drawTable($request, $this->charity->QueryTable($request));

        $datatable['data'] = CharityResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $charity = $this->charity->getModel();
        return $this->view('create',compact('charity'));
    }

    public function store(CharityRequest $request)
    {
        try {
            $create = $this->charity->create($request);

            if (is_array($create) && isset($create['status']) && $create['status'] == 0) {
                return Response()->json(['errors' =>$create['data']],400);
            }elseif ($create) {

                return Response()->json([true , __('apps::dashboard.messages.created')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        $charity = $this->charity->findById($id);
        return $this->view('show' , compact('charity'));
    }

    public function edit($id)
    {
        $charity = $this->charity->findById($id);

        return $this->view('edit',compact('charity'));
    }

    public function update(CharityRequest $request, $id)
    {
        try {
            $update = $this->charity->update($request,$id);

            if (is_array($update) && isset($update['status']) && $update['status'] == 0) {
                return Response()->json(['errors' =>$update['data']],400);
            }elseif ($update) {

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
            $delete = $this->charity->delete($id);

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
            $deleteSelected = $this->charity->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
