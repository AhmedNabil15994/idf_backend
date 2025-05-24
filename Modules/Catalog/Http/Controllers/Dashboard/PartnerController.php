<?php

namespace Modules\Catalog\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Catalog\Http\Requests\Dashboard\PartnerRequest;
use Modules\Catalog\Transformers\Dashboard\PartnerResource;
use Modules\Catalog\Repositories\Dashboard\PartnerRepository as Partner;

class PartnerController extends Controller
{
    private $partner;

    function __construct(Partner $partner)
    {
        $this->partner = $partner;
    }

    public function index()
    {
        return view('catalog::dashboard.partners.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->partner->QueryTable($request));

        $datatable['data'] = PartnerResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $partner = $this->partner->getModel();
        return view('catalog::dashboard.partners.create',compact('partner'));
    }

    public function store(PartnerRequest $request)
    {
        try {
            $create = $this->partner->create($request);

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
        return view('catalog::dashboard.partners.show');
    }

    public function edit($id)
    {
        $partner = $this->partner->findById($id);

        return view('catalog::dashboard.partners.edit',compact('partner'));
    }

    public function update(PartnerRequest $request, $id)
    {
        try {
            $update = $this->partner->update($request,$id);

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
            $delete = $this->partner->delete($id);

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
            $deleteSelected = $this->partner->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
