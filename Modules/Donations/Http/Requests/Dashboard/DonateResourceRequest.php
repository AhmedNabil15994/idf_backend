<?php

namespace Modules\Donations\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class DonateResourceRequest extends FormRequest
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
                abort(404);
            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'name' => 'required',
                    'phone' => 'required|numeric',
                    'item_types' => 'required|array',
                    'item_types.*' => 'required|exists:item_types,id',
                    'quantity' => 'required|numeric|min:0',
                    'categories' => 'required',
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
        $message = [
            'name.required' => __('donations::dashboard.donation_resources.validation.name.required'),
            'phone.required' => __('donations::dashboard.donation_resources.validation.phone.required'),
            'phone.numeric' => __('donations::dashboard.donation_resources.validation.phone.required'),
            'item_types.required' => __('donations::dashboard.donation_resources.validation.item_types.required'),
            'item_types.array' => __('donations::dashboard.donation_resources.validation.item_types.required'),
            'item_types.*.required' => __('donations::dashboard.donation_resources.validation.item_types.required'),
            'item_types.*.exists' => __('donations::dashboard.donation_resources.validation.item_types.required'),
            'quantity.required' => __('donations::dashboard.donation_resources.validation.quantity.required'),
            'quantity.numeric' => __('donations::dashboard.donation_resources.validation.quantity.required'),
            'quantity.min' => __('donations::dashboard.donation_resources.validation.quantity.min'),
            'categories.required' => __('donations::dashboard.donation_resources.validation.categories.required'),
        ];

        return $message;

    }
}
