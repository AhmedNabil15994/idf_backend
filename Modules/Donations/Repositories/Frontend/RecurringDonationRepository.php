<?php

namespace Modules\Donations\Repositories\Frontend;

use Illuminate\Http\Request;
use Modules\Authentication\Repositories\Frontend\DonorRepository;
use Illuminate\Support\Facades\DB;
use Modules\Donations\Entities\RecurringDonation;
use Modules\Projects\Repositories\Frontend\ProjectRepository;
use Modules\User\Repositories\Dashboard\UserRepository;

class RecurringDonationRepository
{

    private $donation;
    private $user;
    private $project;
    protected $donorRepository;

    function __construct(RecurringDonation $donation)
    {
        $this->donation = $donation;
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

    public function count()
    {
        $nationalities = $this->donation->active()->count();
        return $nationalities;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->donation->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function findById($id)
    {
        $donation = $this->donation->find($id);
        return $donation;
    }

    public function create(Request $request , $project = null)
    {
        DB::beginTransaction();

        try {

            $donation = $this->donation->create([
                'user_id' => auth()->user()->id,
                'total' => $request->amount,
                'project_id' => $request->project_id,
                'time_period' => $request->time_period,
                'end_at' => $request->end_at,
            ]);

            $donation->refresh();

            DB::commit();

            return $donation;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function update($request)
    {
        $donation = $this->findById($request->CustomerReference);
        DB::beginTransaction();

        try {
            if($donation){
                if($request->InvoiceStatus == 'Paid'){
                    $donation->status = 'paid';
                    $donation->paid_response = $request->all();
                    $donation->save();
                }elseif($request->InvoiceStatus == 'Canceled'){

                    $donation->forceDelete();
                }
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function register($request)
    {
        $request->merge([
            'status' => 1,
            'mobile' => $request->register_phone,
            'name' => $request->register_name,
            'phone' => $request->register_phone,
            'password' => $request->register_password,
        ]);

        $create = $this->donorRepository->create($request);

        if (is_array($create) && isset($create['status']) && $create['status'] == 0) {

            return $create;

        } elseif ($create) {
            $this->login($request);
            return $create;
        }
    }
}
