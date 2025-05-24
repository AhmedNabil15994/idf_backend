<?php

namespace Modules\Donations\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Donations\Http\Requests\Dashboard\ItemTypeRequest;
use Modules\Donations\Transformers\Dashboard\ItemTypeResource;
use Modules\Donations\Repositories\Dashboard\ItemTypeRepository as ItemType;

class ItemTypeController extends Controller
{
    private $item_type;
    private $view_path = 'donations::dashboard.item-types';

    function __construct(ItemType $item_type)
    {
        $this->item_type = $item_type;
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
        $datatable = DataTable::drawTable($request, $this->item_type->QueryTable($request));

        $datatable['data'] = ItemTypeResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $item_type = $this->item_type->getModel();
        return $this->view('create',compact('item_type'));
    }

    public function store(ItemTypeRequest $request)
    {
        try {
            $create = $this->item_type->create($request);

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
        $item_type = $this->item_type->findById($id);

        return $this->view('edit',compact('item_type'));
    }

    public function update(ItemTypeRequest $request, $id)
    {
        try {
            $update = $this->item_type->update($request,$id);

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
            $delete = $this->item_type->delete($id);

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
            $deleteSelected = $this->item_type->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
