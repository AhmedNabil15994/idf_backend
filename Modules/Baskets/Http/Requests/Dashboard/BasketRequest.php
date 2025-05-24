<?php

namespace Modules\Baskets\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class BasketRequest extends FormRequest
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
                    'description.*' => 'nullable',
                    'price' => 'required|numeric|min:0',
                    'quantity' => 'required|numeric|min:0',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'title.*' => 'required|unique:food_basket_translations,title,' . $this->id . ',food_basket_id',
                    'description.*' => 'nullable',
                    'price' => 'required|numeric|min:0',
                    'quantity' => 'required|numeric|min:0',
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
            'price.required' => __('baskets::dashboard.baskets.validation.price.required'),
            'price.numeric' => __('baskets::dashboard.baskets.validation.price.numeric'),
            'price.min' => __('baskets::dashboard.baskets.validation.price.min'),
            'quantity.required' => __('baskets::dashboard.baskets.validation.quantity.required'),
            'quantity.numeric' => __('baskets::dashboard.baskets.validation.quantity.numeric'),
            'quantity.min' => __('baskets::dashboard.baskets.validation.quantity.min'),
        ];

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

            $v["title." . $key . ".required"] = __('baskets::dashboard.baskets.validation.title.required') . ' - ' . $value['native'] . '';

            $v["title." . $key . ".unique"] = __('baskets::dashboard.baskets.validation.title.unique') . ' - ' . $value['native'] . '';

            $v["description." . $key . ".required"] = __('baskets::dashboard.baskets.validation.description.required') . ' - ' . $value['native'] . '';

            $v["description." . $key . ".unique"] = __('baskets::dashboard.baskets.validation.description.unique') . ' - ' . $value['native'] . '';

        }

        return $v;

    }
}
