<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiseaseHealthStoreRequest extends FormRequest
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
            'animal_info_id'        => 'required',
            'type'                  => 'required',
            'breed'                 => 'required|string|max:80',
            'disease_name'          => 'required|string|max:150',
            'clinical_sign'         => 'required|string|max:150',
            'disease_season'        => 'required|string|max:150',
            'report'                => 'required|string|max:80',
            'deworming_date'        => 'required|date',
            'dipping_date'          => 'required|date',
            'ppr_vac_date'          => 'required|date',
            'fmd_vac_date'          => 'required|date',
            'pox_vacn_date'         => 'required|date',
            'contagious_vac_date'   => 'required|date',
        ];
    }
}
