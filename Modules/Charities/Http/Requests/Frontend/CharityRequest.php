<?php

namespace Modules\Charities\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CharityRequest extends FormRequest
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
                    'charity_name' => 'required|unique:charity_translations,title',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                ];

            //handle updates
            case 'put':
            case 'PUT':
//                return [
//                    'title.*' => 'required|unique:charity_translations,title,' . $this->id . ',charity_id',
//                    'description' => 'nullable|array',
//                    'description.*' => 'nullable|unique:charity_translations,description,' . $this->id . ',charity_id',
//                    'address' => 'required',
//                    'email' => 'required|email',
//                    'phone' => 'required|numeric',
//                    'password' => 'nullable|min:6',
//                    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
           'name.required' => __('charities::frontend.charities.validation.name.required'),
           'charity_name.unique' => __('charities::frontend.charities.validation.charity_name.unique'),
           'charity_name.required' => __('charities::frontend.charities.validation.charity_name.required'),
           'email.required' => __('charities::frontend.charities.validation.email.required'),
           'email.email' => __('charities::frontend.charities.validation.email.email'),
           'email.unique' => __('charities::frontend.charities.validation.email.unique'),
           'phone.required' => __('charities::frontend.charities.validation.phone.required'),
           'phone.unique' => __('charities::frontend.charities.validation.phone.unique'),
        ];

        return $v;

    }
}
