<?php

namespace Modules\Donations\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Donations\Http\Requests\Dashboard\DonateResourceRequest;
use Modules\Donations\Transformers\Dashboard\DonateResourceResource;
use Modules\Donations\Repositories\Dashboard\DonateResourceRepository as DonationResource;

class DonateResourceController extends Controller
{
    private $donate_resource;
    private $view_path = 'donations::dashboard.donate-resources';

    function __construct(DonationResource $donate_resource)
    {
        $this->donate_resource = $donate_resource;
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
        $datatable = DataTable::drawTable($request, $this->donate_resource->QueryTable($request));

        $datatable['data'] = DonateResourceResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        abort(404);
    }

    public function store(DonateResourceRequest $request)
    {
        abort(404);
    }

    public function show($id)
    {

        return $this->view('show');
    }

    public function edit($id)
    {
        $donate_resource = $this->donate_resource->findById($id);

        return $this->view('edit',compact('donate_resource'));
    }

    public function update(DonateResourceRequest $request, $id)
    {
        try {
            $update = $this->donate_resource->update($request,$id);

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
            $delete = $this->donate_resource->delete($id);

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
            $deleteSelected = $this->donate_resource->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
