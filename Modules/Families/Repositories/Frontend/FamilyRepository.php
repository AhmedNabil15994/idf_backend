<?php

namespace Modules\Families\Repositories\Frontend;

use Illuminate\Http\Request;
use Modules\Families\Entities\Family;
use Illuminate\Support\Facades\DB;
use Modules\Families\Entities\FamilyMember;

class FamilyRepository
{
    private $family;
    private $member_model;

    function __construct(Family $family, FamilyMember $member_model)
    {
        $this->family = $family;
        $this->member_model = $member_model;
    }

    public function getModel()
    {
        return $this->family;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $families = $this->family->orderBy($order, $sort)->get();
        return $families;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $families = $this->family->orderBy($order, $sort)->get();
        return $families;
    }

    public function count()
    {
        $families = $this->family->count();
        return $families;
    }

    public function helpedCount()
    {
        $families = $this->family->has('baskets')->count();
        return $families;
    }

    public function findById($id)
    {
        $family = $this->family->findOrFail($id);
        return $family;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            if (count($request->members_names) != $request->members_count)
                return ['status' => 0,
                    'message' => __('families::dashboard.families.validation.members.not_equal'),
                    'data' => ['national_ids' => __('families::dashboard.families.validation.members.not_equal')]
                ];

            $family = $this->createFamily($request);
            $family_head = $this->createFamilyHead($request, $family);
            $address = $this->createAddress($request, $family);
            $baaskets = $this->attachBaskets($request, $family);
            $create_members = $this->createMembers($request, $family);

            if (!$create_members)
                return ['status' => 0,
                    'message' => __('families::dashboard.families.validation.members_national_ids.unique'),
                    'data' => ['members_national_ids' => __('families::dashboard.families.validation.members_national_ids.unique')]
                ];

            if ($request->attachments && count($request->attachments)) {
                foreach ($request->attachments as $attachments) {

                    $family->addMedia($attachments)->toMediaCollection('images');
                }
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    private function createFamily(Request $request)
    {
        return $this->family->create($request->only('members_count', 'charity_id'));
    }

    private function updateFamily(Request $request, $family)
    {
        return $family->update($request->only('members_count', 'charity_id'));
    }

    private function createAddress(Request $request, $family)
    {
        return $family->address()->create($request->only('region_id', 'street', 'building_number', 'floor_number', 'apartment', 'gada_number', 'ale_number'));
    }

    private function updateAddress(Request $request, $address)
    {
        return $address->update($request->only('region_id', 'street', 'building_number', 'floor_number', 'apartment', 'gada_number', 'ale_number'));
    }

    private function createFamilyHead(Request $request, $family)
    {
        return $family->members()->create([
            'nationality_id' => $request->head_nationality_id,
            'religion_id' => $request->head_religion_id,
            'national_id' => $request->head_national_id,
            'name' => $request->head_name,
            'type' => 'leader',
            'gender' => $request->head_gender,
            'phone' => $request->head_phone,
            'current_salary' => $request->head_current_salary,
            'marital_status' => $request->head_marital_status,
        ]);
    }

    private function updateFamilyHead(Request $request, $family)
    {
        if ($this->member_model
            ->where('id', '!=', optional($family->head_info)->id)
            ->where('national_id', $request->head_national_id)->first()) {
            return false;
        }

        return $family->head_info->update([
            'nationality_id' => $request->head_nationality_id,
            'religion_id' => $request->head_religion_id,
            'national_id' => $request->head_national_id,
            'name' => $request->head_name,
            'type' => 'leader',
            'gender' => $request->head_gender,
            'phone' => $request->head_phone,
            'current_salary' => $request->head_current_salary,
            'marital_status' => $request->head_marital_status,
        ]);
    }

    private function createMembers(Request $request, $family)
    {
        foreach ($request->members_names as $key => $value) :

            if ($this->member_model->where('national_id', $request->members_national_ids[$key])->first()) {
                return false;
            }

            if ($value != 'ex_members_name') {
                $family->members()->create([
                    'nationality_id' => $request->head_nationality_id,
                    'religion_id' => $request->head_religion_id,
                    'national_id' => $request->members_national_ids[$key],
                    'name' => $value,
                    'type' => 'member',
                ]);
            }
        endforeach;
        return true;
    }

    private function attachBaskets(Request $request, $family)
    {
        if ($request->baskets) {

            foreach ($request->baskets as $key => $basket_id) :

                if (isset($request->basket_quantities[$key]) && $request->basket_quantities[$key])
                    $family->baskets()->attach($basket_id, ['quantity' => $request->basket_quantities[$key]]);

            endforeach;
            return true;
        }
    }

    private function syncBaskets(Request $request, $family)
    {
        $family->baskets()->detach();
        if ($request->baskets) {
            foreach ($request->baskets as $key => $basket_id) :

                if (isset($request->basket_quantities[$key]) && $request->basket_quantities[$key])
                    $family->baskets()->attach($basket_id, ['quantity' => $request->basket_quantities[$key]]);

            endforeach;
            return true;
        }
    }

    private function forceDeleteMembers($family)
    {
        $family->members()->where('type', 'member')->forceDelete();
    }
}
