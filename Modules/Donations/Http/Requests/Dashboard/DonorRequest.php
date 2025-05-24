<?php

namespace Modules\Donations\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class DonorRequest extends FormRequest
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
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'password' => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'password' => 'required',
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
            'name.required' => __('donations::dashboard.donors.validation.name.required'),
            'email.required' => __('donations::dashboard.donors.validation.email.required'),
            'email.email' => __('donations::dashboard.donors.validation.email.email'),
            'email.unique' => __('donations::dashboard.donors.validation.email.unique'),
            'phone.required' => __('donations::dashboard.donors.validation.phone.required'),
            'phone.numeric' => __('donations::dashboard.donors.validation.phone.required'),
            'password.required' => __('donations::dashboard.donors.validation.password.required'),
            'password.min' => __('donations::dashboard.donors.validation.password.min'),
        ];

        return $v;

    }
}
