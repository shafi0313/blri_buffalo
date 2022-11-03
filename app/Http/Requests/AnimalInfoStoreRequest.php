<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalInfoStoreRequest extends FormRequest
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
            'farm_id' => 'sometimes',
            'community_id' => 'sometimes',
            'animal_cat_id' => 'sometimes',
            'animal_sub_cat_id' => 'sometimes',
            'type' => 'required',
            'm_type' => 'sometimes',
            'a_type' => 'sometimes',
            'sire' => 'required',
            'dam' => 'required',
            'animal_tag' => 'required',
            'color' => 'sometimes',
            'sex' => 'required',
            'birth_wt' => 'required',
            'litter_size' => 'required',
            'generation' => 'required',
            'paity' => 'sometimes',
            'dam_milk' => 'sometimes',
            'd_o_b' => 'required',
            'season_d_o_b' => 'sometimes',
            'death_date' => 'sometimes',
            'remark' => 'nullable',
        ];
    }
}
