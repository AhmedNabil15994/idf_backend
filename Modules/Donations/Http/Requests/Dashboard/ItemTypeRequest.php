<?php

namespace Modules\Donations\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ItemTypeRequest extends FormRequest
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
                  'title.*'         => 'required|unique:item_type_translations,title',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'title.*'          => 'required|unique:item_type_translations,title,'.$this->id.',item_type_id',
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

          $v["title.".$key.".required"]  = __('donations::dashboard.item_types.validation.title.required').' - '.$value['native'].'';

          $v["title.".$key.".unique"]    = __('donations::dashboard.item_types.validation.title.unique').' - '.$value['native'].'';

        }

        return $v;

    }
}
