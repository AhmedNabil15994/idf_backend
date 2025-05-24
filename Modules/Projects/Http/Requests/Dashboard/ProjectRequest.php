<?php

namespace Modules\Projects\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
                    'title.*' => 'required|unique:food_basket_translations,title',
                    'description.*' => 'nullable|unique:food_basket_translations,description',
                    'amount_to_collect' => 'numeric|min:0',
                    'country_id' => 'required|exists:countries,id',
                    'categories' => 'required|array',
                    'categories.*' => 'exists:categories,id',
                    'type' => 'required|in:link,project',
                    'link' => 'required_if:type,link',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'title.*' => 'required|unique:food_basket_translations,title,' . $this->id . ',food_basket_id',
                    'description.*' => 'nullable|unique:food_basket_translations,description,' . $this->id . ',food_basket_id',
                    'amount_to_collect' => 'numeric|min:0',
                    'country_id' => 'required|exists:countries,id',
                    'categories' => 'required|array',
                    'categories.*' => 'exists:categories,id',
                    'type' => 'required|in:link,project',
                    'link' => 'required_if:type,link',
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
            'link.required_if' => __('slider::dashboard.sliders.validation.link.required'),
            'amount_to_collect.numeric' => __('projects::dashboard.projects.validation.amount_to_collect.numeric'),
            'amount_to_collect.min' => __('projects::dashboard.projects.validation.amount_to_collect.min'),
            'country_id.required' => __('projects::dashboard.projects.validation.country_id.required'),
            'country_id.exists' => __('projects::dashboard.projects.validation.country_id.required'),
            'categories.required' => __('projects::dashboard.projects.validation.categories.required'),
            'categories.array' => __('projects::dashboard.projects.validation.categories.required'),
            'categories.*.exists' => __('projects::dashboard.projects.validation.categories.required'),
        ];

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

            $v["title." . $key . ".required"] = __('projects::dashboard.projects.validation.title.required') . ' - ' . $value['native'] . '';

            $v["title." . $key . ".unique"] = __('projects::dashboard.projects.validation.title.unique') . ' - ' . $value['native'] . '';

            $v["description." . $key . ".required"] = __('projects::dashboard.projects.validation.description.required') . ' - ' . $value['native'] . '';

            $v["description." . $key . ".unique"] = __('projects::dashboard.projects.validation.description.unique') . ' - ' . $value['native'] . '';

        }

        return $v;

    }
}
