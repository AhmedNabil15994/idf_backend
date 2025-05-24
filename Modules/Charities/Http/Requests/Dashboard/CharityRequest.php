<?php

namespace Modules\Charities\Http\Requests\Dashboard;

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
                    'title.*' => 'required|unique:charity_translations,title',
                    'description' => 'nullable|array',
                    'description.*' => 'nullable|unique:charity_translations,description',
                    'address' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'password' => 'required|min:6',
                    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'title.*' => 'required|unique:charity_translations,title,' . $this->id . ',charity_id',
                    'description' => 'nullable|array',
                    'description.*' => 'nullable|unique:charity_translations,description,' . $this->id . ',charity_id',
                    'address' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'password' => 'nullable|min:6',
                    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
           'address.required' => __('charities::dashboard.charities.validation.address.required'),
           'email.required' => __('charities::dashboard.charities.validation.email.required'),
           'email.email' => __('charities::dashboard.charities.validation.email.email'),
           'email.unique' => __('charities::dashboard.charities.validation.email.unique'),
           'password.required' => __('charities::dashboard.charities.validation.password.required'),
           'phone.required' => __('charities::dashboard.charities.validation.phone.required'),
           'phone.numeric' => __('charities::dashboard.charities.validation.phone.required'),
           'password.min' => __('charities::dashboard.charities.validation.password.min'),
           'logo.image' => __('charities::dashboard.charities.validation.logo.image'),
           'logo.mimes' => __('charities::dashboard.charities.validation.logo.mimes'),
        ];

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

            $v["title." . $key . ".required"] = __('charities::dashboard.charities.validation.title.required') . ' - ' . $value['native'] . '';

            $v["title." . $key . ".unique"] = __('charities::dashboard.charities.validation.title.unique') . ' - ' . $value['native'] . '';

            $v["description." . $key . ".required"] = __('charities::dashboard.charities.validation.description.required') . ' - ' . $value['native'] . '';

            $v["description." . $key . ".unique"] = __('charities::dashboard.charities.validation.description.unique') . ' - ' . $value['native'] . '';

        }

        return $v;

    }
}
