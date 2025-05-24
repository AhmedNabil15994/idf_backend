<?php

namespace Modules\Areas\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class GovernorateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod())
        {
            // handle creates
            case 'post':
            case 'POST':

                return [
                  'title.*'         => 'required|unique:governorate_translations,title',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'title.*'          => 'required|unique:governorate_translations,title,'.$this->id.',governorate_id',
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

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

          $v["title.".$key.".required"]  = __('areas::dashboard.governorates.validation.title.required').' - '.$value['native'].'';

          $v["title.".$key.".unique"]    = __('areas::dashboard.governorates.validation.title.unique').' - '.$value['native'].'';

        }

        return $v;

    }
}
