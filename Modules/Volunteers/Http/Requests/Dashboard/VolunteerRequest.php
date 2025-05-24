<?php

namespace Modules\Volunteers\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class VolunteerRequest extends FormRequest
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
                    'charity_id' => 'nullable|exists:charities,id',
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'password' => 'required|min:6',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'charity_id' => 'nullable|exists:charities,id',
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'password' => 'nullable|min:6',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
           'name.required' => __('volunteers::dashboard.volunteers.validation.name.required'),
           'email.required' => __('volunteers::dashboard.volunteers.validation.email.required'),
           'email.email' => __('volunteers::dashboard.volunteers.validation.email.email'),
           'password.required' => __('volunteers::dashboard.volunteers.validation.password.required'),
           'phone.required' => __('volunteers::dashboard.volunteers.validation.phone.required'),
           'phone.numeric' => __('volunteers::dashboard.volunteers.validation.phone.required'),
           'password.min' => __('volunteers::dashboard.volunteers.validation.password.min'),
           'image.image' => __('volunteers::dashboard.volunteers.validation.logo.image'),
           'image.mimes' => __('volunteers::dashboard.volunteers.validation.logo.mimes'),
        ];

        return $v;

    }
}
