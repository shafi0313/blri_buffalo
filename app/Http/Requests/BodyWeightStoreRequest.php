<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BodyWeightStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'month_1' => 'nullable|numeric',
            'month_2' => 'sometimes',
            'month_3' => 'sometimes',
            'month_4' => 'sometimes',
            'month_5' => 'sometimes',
            'month_6' => 'sometimes',
            'month_7' => 'sometimes',
            'month_8' => 'sometimes',
            'month_9' => 'sometimes',
            'month_10' => 'sometimes',
            'month_11' => 'sometimes',
            'month_12' => 'sometimes',
            'g_rate_month_3' => 'sometimes',
            'g_rate_month_6' => 'sometimes',
            'g_rate_month_9' => 'sometimes',
            'g_rate_month_10' => 'sometimes',
        ];
    }
}
