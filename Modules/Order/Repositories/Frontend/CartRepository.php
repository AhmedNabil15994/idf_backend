<?php

namespace Modules\Order\Repositories\Frontend;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Authentication\Foundation\DonorAuthentication;
use Modules\Authentication\Repositories\Frontend\DonorRepository;
use Modules\Donations\Entities\Donation;
use Modules\Order\Transformers\Frontend\CartItemsResource;
use Modules\Projects\Repositories\Frontend\ProjectRepository;

class CartRepository
{
    use DonorAuthentication;

    private $donation;
    private $project;
    protected $donorRepository;

    function __construct(ProjectRepository $project, Donation $donation)
    {
        $this->donation = $donation;
        $this->project = $project;
        $this->donorRepository = new DonorRepository;
    }

    public function add(Request $request, $project)
    {
        DB::beginTransaction();

        try {
            $project = $this->project->findById($project);

            if (!$project)
                return false;

            Cart::add($project, $project->translate(locale())->title, 1, $request->amount);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function remove($rowId)
    {
        DB::beginTransaction();

        try {

            Cart::remove($rowId);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function CheckOut(Request $request)
    {
        DB::beginTransaction();

        try {

            if (!self::checkDonor()) {

                if ($request->donor_type == 'quick_donation' && $request->register_password && !empty($request->register_password)) {

                    $register = $this->register($request);

                    if (is_array($register) && isset($register['status']) && $register['status'] == 0) {

                        return $register;
                    }
                }
            }

            $items = Cart::content();
            $donation = $this->donation->create([
                'donor_id' => self::checkDonor() ? optional(auth()->user()->donor)->id : null,
                'total' => Cart::subtotal(),
                'donor_type' => $request->donor_type,
                'name' => $request->donor_type == 'quick_donation' ? $request->register_name : null,
                'mobile' => $request->donor_type == 'quick_donation' ? $request->register_phone : null,
            ]);

            $donation->status = 'pending';
            $donation->save();

            foreach ($items as $item) {
                $project = $this->project->findById($item->id->id);

                if (!$project)
                    return false;

                $donation->projects()->attach($project, [
                    'amount' => $item->price * $item->qty,
                ]);
            }

            DB::commit();
            Cart::destroy();
            return $donation;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function GetCartCount()
    {
        return Cart::count();
    }

    public function GetCartItems()
    {
        return CartItemsResource::collection(Cart::content())->jsonSerialize();
    }

    public function GetTotalPrice()
    {
        return number_format(Cart::subtotal(), 1);
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
