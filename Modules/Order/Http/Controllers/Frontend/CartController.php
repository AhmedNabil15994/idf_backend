<?php

namespace Modules\Order\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Donations\Http\Requests\Frontend\DonationRequest;
use Modules\Order\Http\Requests\Dashboard\OrderRequest;
use Modules\Order\Http\Requests\Frontend\CheckOutRequest;
use Modules\Order\Repositories\Frontend\CartRepository as Cart;
use Modules\Transaction\Services\MyFatoorahPaymentService;
use Modules\Transaction\Services\UPaymentService;

class CartController extends Controller
{
    private $cart;
    private $view_path = 'order::frontend.orders.cart';
    protected $payment;

    function __construct(Cart $cart)
    {
        $this->payment = new MyFatoorahPaymentService;
        $this->cart = $cart;
    }

    /**
     * @param $view
     * @param array $params
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function view($view, $params = [])
    {
        return view($this->view_path . '.' . $view, $params);
    }

    public function index()
    {
        $items = $this->cart->GetCartItems();
        $total = $this->cart->GetTotalPrice();
        return $this->view('index',compact('items','total'));
    }

    public function addToCart(DonationRequest $request, $project)
    {
        try {
            $donation = $this->cart->add($request,$project);

            if ($donation) {
                return Response()->json([true, __('apps::frontend.messages.created'),'cart_count' => $this->cart->GetCartCount()]);
            }

            return Response()->json([true, __('apps::frontend.messages.failed')]);

        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function removeItem($rowId)
    {
        try {
            $response = $this->cart->remove($rowId);

            if ($response) {
                return Response()->json(['total' => $this->cart->GetTotalPrice(),'is_final' => $this->cart->GetCartCount() ? 1 : 0,'cart_count' => $this->cart->GetCartCount()]);
            }

            return Response()->json([true, __('apps::frontend.messages.failed')]);

        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function checkout(CheckOutRequest $request)
    {
        try {
            $donation = $this->cart->CheckOut($request);

            if (is_array($donation) && isset($donation['status']) && $donation['status'] == 0) {

                return Response()->json([false, 'errors' => $donation['data']], 400);

            } elseif ($donation) {
                $payment = $this->payment->send($donation, 'donation');
                return Response()->json([true, __('donations::frontend.messages.redirect_to_get_way'),'url' => $payment]);
            }

            return Response()->json([true, __('apps::frontend.messages.failed')]);

        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function create()
    {
        $cart = $this->cart->getModel();
        return $this->view('create', compact('cart'));
    }

    public function store(OrderRequest $request)
    {
        try {
            $create = $this->cart->create($request);

            if ($create) {
                return Response()->json([true, __('apps::dashboard.messages.created')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        $cart = $this->cart->findById($id);
        return $this->view('show', compact('cart'));
    }

    public function edit($id)
    {
        $cart = $this->cart->findById($id);

        return $this->view('edit', compact('cart'));
    }

    public function update(OrderRequest $request, $id)
    {
        try {
            $update = $this->cart->update($request, $id);

            if ($update) {
                return Response()->json([true, __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->cart->delete($id);

            if ($delete) {
                return Response()->json([true, __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->cart->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true, __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
