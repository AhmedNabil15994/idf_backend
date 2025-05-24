<?php

namespace Modules\Donations\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
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
                $response = [
                    'amount' => 'required|numeric|min:1',
                ];

                if(request()->route()->getName() == 'frontend.donation.direct.donate'){

                    if ($this->request->all()['donor_type'] == 'quick_donation'
                        && isset($this->request->all()['register_password'])
                        && $this->request->all()['register_password']
                        && !empty($this->request->all()['register_password'])) {

                        $response['register_name'] = 'required';
                        $response['register_phone'] = 'required|numeric|digits_between:8,8';
                        $response['register_password'] = 'required|min:6';
                    }
                }

                return $response;
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
            'amount.required' => __('donations::frontend.donation.validation.amount.required'),
            'amount.min' => __('donations::frontend.donation.validation.amount.min'),

            'register_name.required' => __('authentication::frontend.register.validations.name.required'),
            
            'register_phone.required' => __('authentication::frontend.register.validations.phone.required'),
            'register_phone.numeric' => __('authentication::frontend.register.validations.phone.required'),
            'register_phone.digits_between' => __('authentication::frontend.register.validations.phone.digits_between'),
            'register_phone.unique' => __('authentication::frontend.register.validations.phone.unique'),
            'register_password.required' => __('authentication::frontend.register.validations.password.required'),
            'register_password.min' => __('authentication::frontend.register.validations.password.min'),
            'register_password.confirmed' => __('authentication::frontend.register.validations.password.confirmed'),
        ];

        return $message;
    }
}
