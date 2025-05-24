<?php

namespace Modules\Baskets\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Baskets\Http\Requests\Dashboard\BasketRequest;
use Modules\Baskets\Transformers\Dashboard\BasketResource;
use Modules\Baskets\Repositories\Dashboard\BasketRepository as Basket;

class BasketController extends Controller
{
    private $basket;
    private $view_path = 'baskets::dashboard.baskets';

    function __construct(Basket $basket)
    {
        $this->basket = $basket;
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
        $datatable = DataTable::drawTable($request, $this->basket->QueryTable($request));

        $datatable['data'] = BasketResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $basket = $this->basket->getModel();
        return $this->view('create',compact('basket'));
    }

    public function store(BasketRequest $request)
    {
        try {
            $create = $this->basket->create($request);

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

    public function getMaxNumber($id)
    {
        $record = $this->basket->findById($id);
        $max = $record->AvailableQuantity;

        if ($record)
            return response()->json($max);
        else
            return response()->json([],400);
    }

    public function edit($id)
    {
        $basket = $this->basket->findById($id);

        return $this->view('edit',compact('basket'));
    }

    public function update(BasketRequest $request, $id)
    {
        try {
            $update = $this->basket->update($request,$id);

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
            $delete = $this->basket->delete($id);

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
            $deleteSelected = $this->basket->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
