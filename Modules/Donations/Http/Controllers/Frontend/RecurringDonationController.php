<?php

namespace Modules\Donations\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use IlluminateAgnostic\Str\Support\Carbon;
use Modules\Donations\Repositories\Frontend\RecurringDonationRepository as RecurringDonation;
use Modules\Donations\Http\Requests\Frontend\RecurringDonationRequest;
use Modules\Projects\Entities\Project;
use Modules\Projects\Repositories\Frontend\ProjectRepository;
use Modules\Projects\Transformers\Frontend\ProjectResource;
use Modules\Transaction\Services\MyFatoorahRecurringPaymentService;

class RecurringDonationController extends Controller
{

    private $repository;
    private $view_path = 'donations::frontend.recurring-donations';
    protected $payment;
    protected $projectRepo;

    public function __construct(RecurringDonation $repository, ProjectRepository $projectRepo)
    {
        $this->payment = new MyFatoorahRecurringPaymentService;
        $this->repository = $repository;
        $this->projectRepo = $projectRepo;
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

    public function index(Request $request , $slug = null , $time_period = null , $price = null)
    {

        $projects = pluckModelsCols($this->projectRepo->getAll(),'title','id',true);

//        $slug = "دفعة بلاء ( ربع دينار يومي )";
        $data = Project::
            whereHas('translations', function ($query) use ($slug) {
                $query->where('slug', 'LIKE' , '%' . $slug . '%');
            })->first();

//        dd(da);
//        $data = Project::where('link', 'LIKE' , '%' . $slug . '%')->first();


            $project = ProjectResource::make($data)->jsonSerialize();



        return $this->view('index',compact('projects' , 'project'));
    }

    public function donait(RecurringDonationRequest $request , $slug = null , $time_period = null , $price = null)
    {
        try {
            $donation = $this->repository->create($request);


//            if ($donation->retry_count > 5 )
//            {
//                return Response()->json([false, __('donations::frontend.messages.fail_daily'), 'url' => route('frontend.recurring-donations.index')]);
//            }

            if ($donation) {
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
        return redirect(route('frontend.recurring-donations.index'));
    }

    public function failed(Request $request)
    {
        $data = $this->payment->GetPaymentStatus($request->paymentId , 'paymentId');
        $model = $this->repository->update($data);
        session()->flash('error', __('apps::frontend.messages.failed'));
        return redirect(route('frontend.recurring-donations.index'));
    }

    public function delete($id)
    {
        try {
            $donation = $this->repository->findById($id);

            if ($donation) {
                $deletePayment = $this->payment->delete($donation);
                return Response()->json([true, __('Recurring donation') ." #$donation->RecurringId ". __("removed")]);
            }

            return Response()->json([true, __('apps::frontend.messages.failed')]);

        } catch
        (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
