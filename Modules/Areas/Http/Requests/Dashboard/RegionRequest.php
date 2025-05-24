<?php

namespace Modules\Areas\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
                    'title.*' => 'required|unique:region_translations,title',
                    'city_id' => 'required|exists:cities,id',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'title.*' => 'required|unique:region_translations,title,' . $this->id . ',region_id',
                    'city_id' => 'required|exists:cities,id',
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
            'city_id.required' =>  __('areas::dashboard.regions.validation.city_id.required'),
            'city_id.exists' =>  __('areas::dashboard.regions.validation.city_id.required'),
        ];
        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

            $v["title." . $key . ".required"] = __('areas::dashboard.regions.validation.title.required') . ' - ' . $value['native'] . '';

            $v["title." . $key . ".unique"] = __('areas::dashboard.regions.validation.title.unique') . ' - ' . $value['native'] . '';

        }

        return $v;

    }
}
