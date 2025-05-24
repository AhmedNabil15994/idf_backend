<?php

namespace Modules\Donations\Repositories\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Authentication\Foundation\DonorAuthentication;
use Modules\Authentication\Repositories\Frontend\DonorRepository;
use Modules\Donations\Entities\Donation;
use Illuminate\Support\Facades\DB;
use Modules\Projects\Repositories\Frontend\ProjectRepository;
use Modules\Transaction\Services\UPaymentService;
use Modules\User\Entities\User;
use Modules\User\Repositories\Dashboard\UserRepository;
use Illuminate\Support\Facades\Hash;

class DonationRepository
{
    use DonorAuthentication;

    private $donation;
    private $user;
    private $project;
    protected $donorRepository;

    function __construct(Donation $donation , UserRepository $user, ProjectRepository $project)
    {
        $this->donation = $donation;
        $this->user = $user;
        $this->project = $project;
        $this->donorRepository = new DonorRepository;
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

            if($project){

                $project = $this->project->findById($project);

                if(!$project)
                    return false;
            }

            if (!self::checkDonor()) {

                if ($request->donor_type == 'quick_donation' && $request->register_password && !empty($request->register_password)){

                    $register = $this->register($request);

                    if (is_array($register) && isset($register['status']) && $register['status'] == 0) {

                        return $register;
                    }
                }
            }

            $donation = $this->donation->create([
                'donor_id' => self::checkDonor() ? optional(auth()->user()->donor)->id : null,
                'total' => $request->amount,
                'donor_type' => $request->donor_type,
                'name' => $request->donor_type == 'quick_donation' ? $request->register_name : null,
                'mobile' => $request->donor_type == 'quick_donation' ? $request->register_phone : null,
            ]);

            $donation->status = 'pending';
            $donation->save();

            if($project){
                $donation->projects()->attach($project,[
                    'amount' => $request->amount,
                ]);
            }

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
