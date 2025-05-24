<?php

namespace Modules\Slider\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
                    'type' => 'required|in:link,project',
                    'project_id' => 'required_if:type,project',
                    'link' => 'required_if:type,link',
                    'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10000',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'type' => 'required|in:link,project',
                    'project_id' => 'required_if:type,project',
                    'link' => 'required_if:type,link',
                    'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10000',
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
            'type.required' => __('slider::dashboard.sliders.validation.type.required'),
            'type.in' => __('slider::dashboard.sliders.validation.type.in'),
            'project_id.required_if' => __('slider::dashboard.sliders.validation.project.required'),
            'project_id.exists' => __('slider::dashboard.sliders.validation.project.required'),
            'link.required_if' => __('slider::dashboard.sliders.validation.link.required'),
        ];

        return $v;

    }
}
