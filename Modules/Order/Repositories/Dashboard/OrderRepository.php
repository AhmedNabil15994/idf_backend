<?php

namespace Modules\Order\Repositories\Dashboard;

use Illuminate\Http\Request;
use Modules\Families\Repositories\Dashboard\FamilyRepository;
use Modules\Order\Entities\Order;
use PDF;
use Illuminate\Support\Facades\DB;
use Modules\Volunteers\Repositories\Dashboard\VolunteerRepository;

class OrderRepository
{
    private $order;
    private $familyRepository;
    private $volunteerRepository;

    function __construct(Order $order, FamilyRepository $familyRepository, VolunteerRepository $volunteerRepository)
    {
        $this->order = $order;
        $this->familyRepository = $familyRepository;
        $this->volunteerRepository = $volunteerRepository;
    }

    public function getModel()
    {
        return $this->order;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->order->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->order->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function findById($id)
    {
        $order = $this->order->withDeleted()->find($id);
        return $order;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {

            if ($request->families_type == 'all') {
                $families = $this->familyRepository->getModel()->has('baskets')->get();
            } else {

                $families = $this->familyRepository->getModel()->whereIn('id',
                    $request->families)->has('baskets')->get();
            }

            if (!count($families)) {
                return false;
            }

            foreach ($families as $family) {
                $order = $family->orders()->create($request->only('volunteer_id', 'volunteer_note', 'period'));

                $this->attachBaskets($family, $order);
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function attachBaskets($family, $order)
    {
        foreach ($family->baskets as $basket) {
            $order->baskets()->attach($basket->id, ['quantity' => $basket->pivot->quantity]);
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();

        $order = $this->findById($id);
        $request->trash_restore ? $this->restoreSoftDelte($order) : null;

        try {

            $order->update($request->all());

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function restoreSoftDelte($model)
    {
        $model->restore();
    }

    public function translateTable($model, $request)
    {
        foreach ($request['title'] as $locale => $value) {
            $model->translateOrNew($locale)->title = $value;
        }

        $model->save();
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $model = $this->findById($id);

            if ($model->trashed()):
                $model->forceDelete();
            else:
                $model->delete();
            endif;

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function deleteSelected($request)
    {
        DB::beginTransaction();

        try {

            foreach ($request['ids'] as $id) {
                $model = $this->delete($id);
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function assignVolunteers(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $volunteer = $this->volunteerRepository->findById($id);
            if (!$volunteer) {
                return false;
            }

            foreach ($request['ids'] as $id) {
                $model = $this->findById($id);

                if (!$model) {
                    return false;
                }

                $model->update(['volunteer_id' => $volunteer->id]);
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function QueryTable($request)
    {
        $query = $this->order->where(function ($query) use ($request) {
            $query->where('id', 'like', '%'.$request->input('search.value').'%');
            $query->orWhere(function ($query) use ($request) {
                $query->whereHas('family', function ($query) use ($request) {
                    $query->whereHas('members', function ($query) use ($request) {
                        $query->where('type', 'leader')
                            ->where('name', 'like', '%'.$request->input('search.value').'%');
                    });
                });
                $query->orWhereHas('volunteer', function ($query) use ($request) {
                    $query->whereHas('user', function ($query) use ($request) {
                        $query->where('name', 'like', '%'.$request->input('search.value').'%');
                    });
                });
            });
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        if (isset($request['req']['deleted']) && $request['req']['deleted'] == 'only') {

            $query->onlyDeleted();

        } else {
            if (isset($request['req']['from']) && $request['req']['from'] != '') {
                $query->whereDate('created_at', '>=', $request['req']['from']);
            }

            if (isset($request['req']['to']) && $request['req']['to'] != '') {
                $query->whereDate('created_at', '<=', $request['req']['to']);
            }

            if ($request->ids && count($request->ids)) {
                $query->whereIn('id', $request->ids);
            }
            if (isset($request['req']['status']) && $request['req']['status'] == '1') {
                $query->active();
            }

            if (isset($request['req']['status']) && $request['req']['status'] == '0') {
                $query->unactive();
            }

            if (isset($request['req']['volunteer_id']) && $request['req']['volunteer_id'] == '') {
                $query->where('volunteer_id' , $request['req']['volunteer_id']);
            }

            if ((isset($request['req']['governorates']) && $request['req']['governorates'] != '') || (isset($request['req']['city_id']) && $request['req']['city_id'] != '')) {
                $query->whereHas('family', function ($q) use ($request) {

                    $q->whereHas('address', function ($q) use ($request) {

                        $q->whereHas('city', function ($q) use ($request) {

                            if ((isset($request['req']['city_id']) && $request['req']['city_id'] != '')) {
                                $q->where('id', $request['req']['city_id']);
                            }

                            if ((isset($request['req']['governorates']) && $request['req']['governorates'] != '')) {

                                $q->whereHas('governorate', function ($q) use ($request) {

                                    $q->where('id', $request['req']['governorates']);
                                });
                            }

                        });
                    });
                });
            }
        }


            return $query;
        }


    // Generate PDF
    public function createPDF($data, $type = 'pdf')
    {

        $cols = [
            '#' => 'id',
            __('order::dashboard.orders.datatable.volunteer_name') => 'volunteer_id',
            __('order::dashboard.orders.datatable.family_leader_name') => 'family_leader_name',
            __('order::dashboard.orders.datatable.family_members_count') => 'family_members_count',
            __('order::dashboard.orders.datatable.status') => 'status_view',
            __('order::dashboard.orders.datatable.baskets_count') => 'baskets_count',
            __('order::dashboard.orders.datatable.created_at') => 'created_at',
        ];

        $datatableRoute = 'dashboard.installments.datatable';
        $pdf = PDF::loadView('core::dashboard.query-action.print', compact('cols', 'data', 'datatableRoute'), [], [
            'default_font' => 'cairo',
            'title' => setting('app_name', 'ar'),
            'format' => 'A4-L',
            'margin_footer' => 5,
            'watermark' => setting('app_name', 'ar'),
            'orientation' => 'L'
        ]);


        switch ($type) {
            case 'print':
                return $pdf->stream(env('APP_NAME').'.pdf');
                break;
            default:
                return $pdf->download(env('APP_NAME').'.pdf');
        }
    }
}
