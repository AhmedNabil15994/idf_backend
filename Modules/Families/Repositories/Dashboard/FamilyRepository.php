<?php

namespace Modules\Families\Repositories\Dashboard;

use Helper\Attachment;
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

    public function findById($id)
    {
        $family = $this->family->withDeleted()->findOrFail($id);
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

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $family = $this->findById($id);
        try {
            if (count($request->members_names) != $request->members_count)
                return ['status' => 0,
                    'message' => __('families::dashboard.families.validation.members.not_equal'),
                    'data' => ['national_ids' => __('families::dashboard.families.validation.members.not_equal')]
                ];

            $this->updateFamily($request, $family);
            $family_head = $this->updateFamilyHead($request, $family);
            $this->syncBaskets($request, $family);
            $this->updateAddress($request, $family->address);
            $this->forceDeleteMembers($family);

            if (!$family_head)
                return ['status' => 0,
                    'message' => __('families::dashboard.families.validation.members_national_ids.unique'),
                    'data' => ['head_national_id' => __('families::dashboard.families.validation.head_national_id.unique')]
                ];

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
        return $family->address()->create($request->only('city_id', 'region' ,'street', 'building_number', 'floor_number', 'apartment', 'gada_number', 'ale_number'));
    }

    private function updateAddress(Request $request, $address)
    {
        return $address->update($request->only('city_id', 'region', 'street', 'building_number', 'floor_number', 'apartment', 'gada_number', 'ale_number'));
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

    public function attachmentSort(Request $request, $id)
    {
        try {
            $family = $this->findById($id);
            $media = $family->getMedia('images');
            $ordering = $this->buildArray($request->ordering);
            foreach ($ordering as $order => $id) {
                $media->find($id)->order_column = $order;
                $media->find($id)->save();
            }
            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function buildArray($str)
    {
        $response = [];
        $arr = explode('|', $str);
        foreach ($arr as $value) {
            $small_arr = explode(':', $value);
            $response[$small_arr[0]] = $small_arr[1];
        }
        return $response;
    }

    public function restoreSoftDelete($model)
    {
        $model->restore();
    }

    public function translateTable($model, $request)
    {
        foreach ($request['title'] as $locale => $value) {
            $model->translateOrNew($locale)->title = $value;
            $model->translateOrNew($locale)->description = $request['description'] ? $request['description'][$locale] : null;
        }

        $model->save();
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $model = $this->findById($id);

            if ($model->trashed()):
                $model->clearMediaCollection('images');
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

    public function deleteAttachment($family, $id)
    {
        DB::beginTransaction();

        try {

            $family = $this->findById($family);
            $media = $family->getMedia('images');
            $media->find($id)->delete();

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
        $query = $this->family->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere(function ($query) use ($request) {
                $query->whereHas('members', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search.value') . '%')
                        ->orWhere('phone', 'like', '%' . $request->input('search.value') . '%');
                });
            });
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        // Search Countrys by Created Dates
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

        if (isset($request['req']['status']) && $request['req']['status'] == '0')
            $query->unactive();

        return $query;
    }

}
