<?php

namespace Modules\Donations\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Donations\Http\Requests\Dashboard\DonorRequest;
use Modules\Donations\Transformers\Dashboard\DonorResource;
use Modules\Donations\Repositories\Dashboard\DonorRepository as Donor;

class DonorController extends Controller
{
    private $donor;
    private $view_path = 'donations::dashboard.donors';

    function __construct(Donor $donor)
    {
        $this->donor = $donor;
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
        $datatable = DataTable::drawTable($request, $this->donor->QueryTable($request));

        $datatable['data'] = DonorResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $donor = $this->donor->getModel();
        return $this->view('create',compact('donor'));
    }

    public function store(DonorRequest $request)
    {
        try {
            $create = $this->donor->create($request);

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
        $donor = $this->donor->findById($id);

        return $this->view('show' , compact('donor'));
    }

    public function edit($id)
    {
        $donor = $this->donor->findById($id);
        return $this->view('edit',compact('donor'));
    }

    public function update(DonorRequest $request, $id)
    {
        try {
            $update = $this->donor->update($request,$id);

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
            $delete = $this->donor->delete($id);

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
            $deleteSelected = $this->donor->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
