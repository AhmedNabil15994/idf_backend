<?php

namespace Modules\Families\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class FamilyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod()) {
            // handle creates
            case 'post':
            case 'POST':

                return [
                    // family data
                    'head_name' => 'required',
                    'head_phone' => 'required|numeric',
                    'head_national_id' => 'required|unique:family_members,national_id',
                    'head_religion_id' => 'required|exists:religions,id',
                    'head_nationality_id' => 'required|exists:nationalities,id',
                    'head_current_salary' => 'required|numeric|min:0',
                    'head_gender' => 'required|in:male,female',
                    'head_marital_status' => 'required|in:married,single,widower,divorce',
                    'members_count' => 'required|numeric|min:1',
                    ///////////////////////////////////////

                    // family members data
                    'members_names' => 'required|array',
                    'members_names.*' => 'required',
                    'members_national_ids' => 'required|array',
                    'members_national_ids.*' => 'required|unique:family_members,national_id',
                    ////////////////////////////////////

                    // family address data
                    'governorates' => 'required|exists:governorates,id',
                    'cities' => 'required|exists:cities,id',
                    'region_id' => 'required|exists:regions,id',
                    'ale_number' => 'required|numeric',
                    'street' => 'required',
                    'building_number' => 'required|numeric',
                    'floor_number' => 'required|numeric',
                    'apartment' => 'required',
                    ///////////////////////////////////////

                    'charities' => 'nullable|array',
                    'attachments' => 'nullable|array',
                    'attachments.*' => 'max:10000|mimes:doc,docx,pdf,PDF,jpeg,png,jpg,gif',
                ];
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        $v = [
            'head_name.required' => __('families::dashboard.families.validation.head_name.required'),
            'head_phone.required' => __('families::dashboard.families.validation.head_phone.required'),
            'head_phone.numeric' => __('families::dashboard.families.validation.head_phone.required'),
            'head_national_id.required' => __('families::dashboard.families.validation.head_national_id.required'),
            'head_national_id.unique' => __('families::dashboard.families.validation.head_national_id.unique'),
            'head_nationality_id.required' => __('families::dashboard.families.validation.head_nationality_id.required'),
            'head_nationality_id.exists' => __('families::dashboard.families.validation.head_nationality_id.required'),
            'head_religion_id.required' => __('families::dashboard.families.validation.head_religion_id.required'),
            'head_religion_id.exists' => __('families::dashboard.families.validation.head_religion_id.required'),
            'head_current_salary.required' => __('families::dashboard.families.validation.head_current_salary.required'),
            'head_current_salary.numeric' => __('families::dashboard.families.validation.head_current_salary.required'),
            'head_current_salary.min' => __('families::dashboard.families.validation.head_current_salary.min'),
            'head_gender.required' => __('families::dashboard.families.validation.head_gender.required'),
            'head_gender.in' => __('families::dashboard.families.validation.head_gender.required'),
            'head_marital_status.required' => __('families::dashboard.families.validation.head_marital_status.required'),
            'head_marital_status.in' => __('families::dashboard.families.validation.head_marital_status.required'),
            'members_count.required' => __('families::dashboard.families.validation.members_count.required'),
            'members_count.numeric' => __('families::dashboard.families.validation.members_count.required'),
            'members_count.min' => __('families::dashboard.families.validation.members_count.min'),
            'members_names.required' => __('families::dashboard.families.validation.members_names.required'),
            'members_names.*.required' => __('families::dashboard.families.validation.members_names.required'),
            'members_national_ids.required' => __('families::dashboard.families.validation.members_national_ids.required'),
            'members_national_ids.*.required' => __('families::dashboard.families.validation.members_national_ids.required'),
            'members_national_ids.*.unique' => __('families::dashboard.families.validation.members_national_ids.unique'),
            'region_id.required' => __('families::dashboard.families.validation.region_id.required'),
            'region_id.exists' => __('families::dashboard.families.validation.region_id.required'),
            'governorates.required' => __('families::dashboard.families.validation.governorate.required'),
            'governorates.exists' => __('families::dashboard.families.validation.governorate.required'),
            'cities.required' => __('families::dashboard.families.validation.city.required'),
            'cities.exists' => __('families::dashboard.families.validation.city.required'),
            'ale_number.required' => __('families::dashboard.families.validation.ale_number.required'),
            'street.required' => __('families::dashboard.families.validation.street.required'),
            'building_number.required' => __('families::dashboard.families.validation.building_number.required'),
            'floor_number.required' => __('families::dashboard.families.validation.floor_number.required'),
            'apartment.required' => __('families::dashboard.families.validation.apartment.required'),
            'charity_id.exists' => __('families::dashboard.families.validation.charities.exists'),
            'attachments.*.max' => __('families::dashboard.families.validation.attachments.max'),
            'attachments.*.mimes' => __('families::dashboard.families.validation.attachments.mimes'),
        ];

        return $v;

    }
}
