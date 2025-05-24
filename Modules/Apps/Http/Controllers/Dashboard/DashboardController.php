<?php

namespace Modules\Apps\Http\Controllers\Dashboard;

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

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $countFamilies = $this->getCountFamilies($request);
        $countCharities = $this->getCountCharities($request);
        $countVolunteers = $this->getCountVolunteers($request);
        $countDonors = $this->getCountDonors($request);
        $countPendingOrders = $this->getCountOrder($request, 'pending');
        $countDeliveredOrders = $this->getCountOrder($request, 'delivered');
        $countTotalOrders = $this->getCountOrder($request);
        $projectTotalProfit = $this->getCountDonations($request, 'baskets');
        $basketTotalProfit = $this->getCountDonations($request, 'projects');
        $totalProfit = $this->getCountDonations($request);
        $donate_resources = $this->getDonateResources($request);

        return view('apps::dashboard.index',
            compact(
                'countCharities',
                'countDeliveredOrders',
                'countFamilies',
                'countDonors',
                'countVolunteers',
                'countPendingOrders',
                'countTotalOrders',
                'basketTotalProfit',
                'projectTotalProfit',
                'totalProfit',
                'donate_resources'
            ));
    }

    private function getCountFamilies($request)
    {
        return $this->filter($request, (new Family()))->count();
    }

    private function getCountCharities($request)
    {
        return $this->filter($request, (new Charity()))->count();
    }

    private function getCountDonors($request)
    {
        return $this->filter($request, (new Donor()))->count();
    }

    private function getCountVolunteers($request)
    {
        return $this->filter($request, (new Volunteer()))->count();
    }

    private function getDonateResources($request)
    {
        return $this->filter($request, (new DonateResource()))->count();
    }

    private function getCountOrder($request, $status = null)
    {
        return $this->filter($request, (new Order()))->where(function ($query) use ($status) {

            if ($status)
                $query->where('status', $status);

        })->count();
    }

    private function getCountDonations($request, $type = null)
    {
        $donations = $this->filter($request, (new Donation()))->where(function ($query) use ($type) {

            if ($type) {
                switch ($type) {
                    case 'baskets' :
                        $query->has('foodBaskets');
                        break;
                    case 'projects' :
                        $query->has('foodBaskets');
                        break;
                }
            }

            $query->where('donation_status_id', 1);
        });

        if ($donations->count()) {
            return $donations->sum('total');
        } else {
            return 0;
        }
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
