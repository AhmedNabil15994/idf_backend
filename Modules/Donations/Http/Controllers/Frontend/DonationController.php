<?php

namespace Modules\Donations\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authentication\Http\Controllers\Frontend\RegisterController;
use Modules\Donations\Repositories\Frontend\DonationRepository as Donation;
use Modules\Donations\Http\Requests\Frontend\DonationRequest;
use Modules\Transaction\Services\MyFatoorahPaymentService;
use Modules\Transaction\Services\UPaymentService;

class DonationController extends Controller
{

    private $repository;
    private $view_path = 'donations::frontend.donation';
    protected $payment;

    public function __construct(Donation $repository)
    {
        $this->payment = new MyFatoorahPaymentService;
        $this->repository = $repository;
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

    public function directDonation(DonationRequest $request, $project = null)
    {

        try {

            $donation = $this->repository->create($request, $project);

            if (is_array($donation) && isset($donation['status']) && $donation['status'] == 0) {

                return Response()->json([false, 'errors' => $donation['data']], 400);

            } elseif ($donation) {


                $payment = $this->payment->send($donation, 'donation');

                return Response()->json([true, __('donations::frontend.messages.redirect_to_get_way'), 'url' => $payment]);
            }

            return Response()->json([true, __('apps::frontend.messages.failed')]);

        } catch
        (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function success(Request $request)
    {
        $data = $this->payment->GetPaymentStatus($request->paymentId , 'paymentId');
        $model = $this->repository->update($data);
        session()->flash('success', __('apps::frontend.messages.updated'));
        return redirect(route('frontend.home'));
    }

    public function failed(Request $request)
    {
//        dd($request->all());
        $data = $this->payment->GetPaymentStatus($request->paymentId , 'paymentId');

        $model = $this->repository->update($data);
        session()->flash('error', __('apps::frontend.messages.failed'));
        return redirect(route('frontend.home'));
    }
}
