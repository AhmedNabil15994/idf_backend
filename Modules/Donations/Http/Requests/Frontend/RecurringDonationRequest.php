<?php

namespace Modules\Donations\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RecurringDonationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required_if:project_id,!=,7|numeric|min:0.001',
            'project_id' => 'required|exists:projects,id',
            'time_period' => 'required_if:project_id,!=,7|in:daily,weekly,monthly',
            'end_at' => 'nullable|date|after:today',
        ];
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
        $message = [
            'time_period.required_if' => __('Time period required'),
            'amount.required_if' => __('Amount required'),
            'project_id.required' => __('Project required'),
            'amount.min' => __('donations::frontend.donation.validation.amount.min'),
        ];

        return $message;
    }
}
