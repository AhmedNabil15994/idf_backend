<?php

namespace Modules\Volunteers\Http\Requests\Frontend;

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
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'd_o_b' => 'required|date',
                ];

            //handle updates
//            case 'put':
//            case 'PUT':
//                return [
//                    'charity_id' => 'nullable|exists:charities,id',
//                    'name' => 'required',
//                    'email' => 'required|email',
//                    'phone' => 'required|numeric',
//                    'password' => 'nullable|min:6',
//                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//                ];
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
           'name.required' => __('volunteers::frontend.volunteers.validation.name.required'),
           'email.required' => __('volunteers::frontend.volunteers.validation.email.required'),
           'email.email' => __('volunteers::frontend.volunteers.validation.email.email'),
           'd_o_b.required' => __('volunteers::frontend.volunteers.validation.d_o_b.required'),
           'd_o_b.date' => __('volunteers::frontend.volunteers.validation.d_o_b.required'),
           'phone.required' => __('volunteers::frontend.volunteers.validation.phone.required'),
           'phone.numeric' => __('volunteers::frontend.volunteers.validation.phone.required'),
        ];

        return $v;

    }
}
