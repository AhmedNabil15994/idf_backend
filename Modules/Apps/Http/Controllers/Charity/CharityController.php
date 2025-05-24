<?php

namespace Modules\Apps\Http\Controllers\Charity;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Charities\Entities\Charity;
use Modules\Donations\Entities\DonateResource;
use Modules\Donations\Entities\Donation;
use Modules\Donations\Entities\Donor;
use Modules\Families\Entities\Family;
use Modules\Order\Entities\Order;
use Modules\Volunteers\Entities\Volunteer;

class CharityController extends Controller
{
    private $model;

    public function index(Request $request)
    {
        $this->model = auth()->user()->charity;
        $countFamilies = $this->getCountFamilies($request);
        $countVolunteers = $this->getCountVolunteers($request);
        $countPendingOrders = $this->getCountOrder($request, 'pending');
        $countDeliveredOrders = $this->getCountOrder($request, 'delivered');
        $countTotalOrders = $this->getCountOrder($request);

        return view('apps::charities.index',
            compact(
                'countDeliveredOrders',
                'countFamilies',
                'countVolunteers',
                'countPendingOrders',
                'countTotalOrders'
            ));
    }

    private function getCountFamilies($request)
    {
        return $this->filter($request, $this->model->families())->count();
    }

    private function getCountVolunteers($request)
    {
        return $this->filter($request, $this->model->volunteers())->count();
    }

    private function getCountOrder($request, $status = null)
    {
        return $this->filter($request, $this->model->orders())->where(function ($query) use ($status) {

            if ($status)
                $query->where('status', $status);

        })->count();
    }

    private function filter($request, $model)
    {

        return $model->where(function ($query) use ($request) {

            // Search Users by Created Dates
            if ($request->from)
                $query->whereDate('created_at', '>=', $request->from);

            if ($request->to)
                $query->whereDate('created_at', '<=', $request->to);

        });
    }
}
