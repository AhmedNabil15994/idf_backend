<?php

namespace Modules\Order\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Order\Http\Requests\Dashboard\OrderRequest;
use Modules\Order\Transformers\Dashboard\OrderResource;
use Modules\Order\Repositories\Dashboard\OrderRepository as Order;

class OrderController extends Controller
{
    private $order;
    private $view_path = 'order::dashboard.orders';

    function __construct(Order $order)
    {
        $this->order = $order;
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
        $datatable = DataTable::drawTable($request, $this->order->QueryTable($request));

        $datatable['data'] = OrderResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function export(Request $request, $type)
    {
        $req = $request->ids;
        $request->merge(['req' => (array)$req]);
        $data = $this->datatable($request);

        switch ($type) {
            case 'pdf':
            case 'print':
                return $this->order->createPDF($data->getData()->data,$type);
                break;
            default:
                return back();
        }
    }

    public function create()
    {
        $order = $this->order->getModel();
        return $this->view('create',compact('order'));
    }

    public function store(OrderRequest $request)
    {
        try {
            $create = $this->order->create($request);

            if ($create) {
                return Response()->json([true , __('apps::dashboard.messages.created')]);
            }

            return Response()->json([false , __('order::dashboard.orders.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        $order = $this->order->findById($id);
        return $this->view('show' , compact('order'));
    }

    public function edit($id)
    {
        $order = $this->order->findById($id);

        return $this->view('edit',compact('order'));
    }

    public function update(OrderRequest $request, $id)
    {
        try {
            $update = $this->order->update($request,$id);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function assignVolunteer(Request $request,$id)
    {
        try {
            $delete = $this->order->assignVolunteers($request,$id);

            if ($delete) {
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
            $delete = $this->order->delete($id);

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
            $deleteSelected = $this->order->deleteSelected($request);

            if ($deleteSelected) {
              return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
