<?php

namespace Modules\Order\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Order\Entities\Order;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod())
        {
            // handle creates
            case 'post':
            case 'POST':

                return [
                  'families_type'         => 'required|in:all,select_families',
                  'families'         => 'required_if:families_type,select_families|array',
                  'families.*'         => 'exists:families,id',
                  'volunteer_id'         => 'nullable|exists:volunteers,id',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'status' => 'required|in:'.implode(',',Order::$status),
                    'volunteer_id'         => 'nullable|exists:volunteers,id',
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
            'families_type.required' => __('order::dashboard.orders.validation.families_type.required'),
            'families_type.in' => __('order::dashboard.orders.validation.families_type.required'),
            'families.required_if' => __('order::dashboard.orders.validation.families.required_if'),
            'families.array' => __('order::dashboard.orders.validation.families.required_if'),
            'families.exists' => __('order::dashboard.orders.validation.families.required_if'),
            'volunteer_id.exists' => __('order::dashboard.orders.validation.volunteer_id.exists'),
            'period.numeric' => __('order::dashboard.orders.validation.period.numeric'),
            'period.min' => __('order::dashboard.orders.validation.period.min'),
            'status.required' => __('order::dashboard.orders.validation.status.required'),
            'status.in' => __('order::dashboard.orders.validation.status.required'),
        ];
        return $v;

    }
}
