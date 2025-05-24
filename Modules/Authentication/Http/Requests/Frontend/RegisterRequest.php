<?php

namespace Modules\Authentication\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'register_name' => 'required',
            'register_phone' => 'required|numeric|digits_between:8,8',
            'register_password' => 'required|confirmed|min:6',
        ];
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
            'register_name.required' => __('authentication::frontend.register.validations.name.required'),
            
            'register_phone.required' => __('authentication::frontend.register.validations.phone.required'),
            'register_phone.numeric' => __('authentication::frontend.register.validations.phone.required'),
            'register_phone.digits_between' => __('authentication::frontend.register.validations.phone.digits_between'),
            'register_phone.unique' => __('authentication::frontend.register.validations.phone.unique'),
            'register_password.required' => __('authentication::frontend.register.validations.password.required'),
            'register_password.min' => __('authentication::frontend.register.validations.password.min'),
            'register_password.confirmed' => __('authentication::frontend.register.validations.password.confirmed'),
        ];

        return $v;
    }
}
