<?php

namespace Modules\Order\Http\Controllers\Charity;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Order\Transformers\Charity\OrderResource;
use Modules\Order\Repositories\Charity\OrderRepository as Order;

class OrderController extends Controller
{
    private $order;
    private $view_path = 'order::charities.orders';

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

    public function show($id)
    {
        $order = $this->order->findById($id);
        return $this->view('show' , compact('order'));
    }
}
