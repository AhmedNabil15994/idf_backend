<?php

namespace Modules\Areas\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
                    'title.*' => 'required|unique:city_translations,title',
                    'governorate_id' => 'required|exists:governorates,id',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'title.*' => 'required|unique:city_translations,title,' . $this->id . ',city_id',
                    'governorate_id' => 'required|exists:governorates,id',
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
            'governorate_id.required' =>  __('areas::dashboard.cities.validation.governorate_id.required'),
            'governorate_id.exists' =>  __('areas::dashboard.cities.validation.governorate_id.required'),
        ];
        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

            $v["title." . $key . ".required"] = __('areas::dashboard.cities.validation.title.required') . ' - ' . $value['native'] . '';

            $v["title." . $key . ".unique"] = __('areas::dashboard.cities.validation.title.unique') . ' - ' . $value['native'] . '';

        }

        return $v;

    }
}
