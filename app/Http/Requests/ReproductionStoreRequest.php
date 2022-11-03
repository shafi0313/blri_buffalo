<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReproductionStoreRequest extends FormRequest
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
            'puberty_age' => 'nullable',
            'service_1st_date' => 'nullable|date',
            'kidding_1st_date' => 'nullable|date',

            'ges_lenght_1st_kidding'  => 'nullable|numeric',
            'age_1st_kidding'  => 'nullable|numeric',
            'litter_size_1st_kidding'  => 'nullable|numeric',
            'milk_production' => 'nullable|numeric',

            'service_2nd_date' => 'nullable|date',
            'kidding_2nd_date' => 'nullable|date',
            'kidding_2nd_liter' => 'nullable|numeric',
            'service_3rd_date' => 'nullable|date',
            'kidding_3rd_date' => 'nullable|date',
            'kidding_3rd_liter' => 'nullable|numeric',
            'service_4th_date' => 'nullable|date',
            'kidding_4th_date' => 'nullable|date',
            'kidding_4th_liter' => 'nullable|numeric',
            'service_5th_date' => 'nullable|date',
            'kidding_5th_date' => 'nullable|date',
            'kidding_5th_liter' => 'nullable|numeric',
            'service_6th_date' => 'nullable|date',
            'kidding_6th_date' => 'nullable|date',
            'kidding_6th_liter' => 'nullable|numeric',
            'remarks' => 'sometimes',
        ];
    }
}
