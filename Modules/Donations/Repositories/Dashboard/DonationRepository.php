<?php

namespace Modules\Donations\Repositories\Dashboard;

use Modules\Donations\Entities\Donation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use PDF;

class DonationRepository
{
    private $donation;
    private $QueryActionsCols;

    function __construct(Donation $donation)
    {
        $this->donation = $donation;
        $this->setQueryActionsCols([
            '#' => 'id',
            __('donations::dashboard.donations.datatable.donor_name') => 'name',
            __('donations::dashboard.donations.datatable.donor_email') => 'email',
            __('donations::dashboard.donations.datatable.donor_mobile') => 'mobile',
            __('donations::dashboard.donations.datatable.total') => 'total',
            __('donations::dashboard.donations.datatable.status') => 'status',
            __('donations::dashboard.donations.modal.projects') => 'projects',
        ]);
    }


    /**
     * @param array $data
     */
    public function setQueryActionsCols(array $data = ['id' => 'id'])
    {
        $this->QueryActionsCols = $data;
    }

    /**
     * @return mixed
     */
    public function getQueryActionsCols()
    {
        return $this->QueryActionsCols;
    }

    public function getModel()
    {
        return $this->donation;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->donation->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->donation->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function findById($id)
    {
        $donation = $this->donation->withDeleted()->find($id);
        return $donation;
    }

    public function restoreSoftDelte($model)
    {
        $model->restore();
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

    public function QueryTable($request)
    {
        $query = $this->donation->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        // Search Donations by Created Dates
        if (isset($request['req']['from']) && $request['req']['from'] != '')
            $query->whereDate('created_at', '>=', $request['req']['from']);

        if (isset($request['req']['to']) && $request['req']['to'] != '')
            $query->whereDate('created_at', '<=', $request['req']['to']);

        if (isset($request['req']['deleted']) && $request['req']['deleted'] == 'only')
            $query->onlyDeleted();

        if (isset($request['req']['deleted']) && $request['req']['deleted'] == 'with')
            $query->withDeleted();

        if (isset($request['req']['status']) && $request['req']['status'] == '1')
            $query->active();

        if (isset($request['req']['project_id']) && $request['req']['project_id'])
            $query->whereHas('projects', function ($q) use ($request) {
                $q->where('donatables.donatable_id', $request['req']['project_id']);
            });

        if (isset($request['req']['status']) && $request['req']['status'] == '0')
            $query->unactive();

        return $query;
    }


    // Generate PDF
    public function createPDF($data, $type = 'pdf')
    {

        $cols = $this->getQueryActionsCols();
        //TODO
        $datatableRoute = 'dashboard.installments.datatable';
        $pdf = PDF::loadView('core::dashboard.query-action.print', compact('cols', 'data', 'datatableRoute'), [], [
            'default_font' => 'cairo',
            'title' => setting('app_name', 'ar'),
            'format' => 'A4-L',
//            'margin_header' => 5,
            'margin_footer' => 5,
            'watermark' => setting('app_name', 'ar'),
            'orientation' => 'L'
        ]);

        // download PDF file with download method

        switch ($type) {
            case 'print':
                return $pdf->stream(env('APP_NAME') . '.pdf');
                break;
            default:
                return $pdf->download(env('APP_NAME') . '.pdf');
        }
    }
}
