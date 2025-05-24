<?php

namespace Modules\Donations\Http\Requests\Frontend;

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
            case 'POST':

                return [
                    'name' => 'required',
                    'phone' => 'required|numeric',
                    'item_types' => 'required|array',
                    'item_types.*' => 'required|exists:item_types,id',
                    'quantities' => 'required|array',
                    'quantities.*' => 'required|numeric|min:0',
                    'categories' => 'required|array',
                    'categories.*' => 'required',
                ];
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
            'name.required' => __('donations::frontend.donate_resources.validation.name.required'),
            'phone.required' => __('donations::frontend.donate_resources.validation.phone.required'),
            'phone.numeric' => __('donations::frontend.donate_resources.validation.phone.numeric'),
            'item_types.required' => __('donations::frontend.donate_resources.validation.item_types.required'),
            'item_types.array' => __('donations::frontend.donate_resources.validation.item_types.required'),
            'item_types.*.required' => __('donations::frontend.donate_resources.validation.item_types.required'),
            'item_types.*.exists' => __('donations::frontend.donate_resources.validation.item_types.required'),
            'quantities.required' => __('donations::frontend.donate_resources.validation.quantities.required'),
            'quantities.*.required' => __('donations::frontend.donate_resources.validation.quantities.required'),
            'quantities.array' => __('donations::frontend.donate_resources.validation.quantities.required'),
            'quantities.*.numeric' => __('donations::frontend.donate_resources.validation.quantities.numeric'),
            'quantities.*.min' => __('donations::frontend.donate_resources.validation.quantities.min'),
            'categories.required' => __('donations::frontend.donate_resources.validation.categories.required'),
            'categories.*.required' => __('donations::frontend.donate_resources.validation.categories.required'),
        ];

        return $message;

    }
}
