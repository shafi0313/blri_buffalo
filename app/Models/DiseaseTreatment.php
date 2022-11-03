<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseTreatment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function animalInfo()
    {
        return $this->belongsTo(AnimalInfo::class, 'animal_info_id', 'id');
    }

    public function diseaseSign()
    {
        return $this->hasOne(DiseaseSign::class, 'disease_treatment_id');
    }

    public function diseaseSigns()
    {
        return $this->hasMany(DiseaseSign::class, 'disease_treatment_id');
    }

    // public function disease()
    // {
    //     return $this->belongsTo(Disease::class, 'disease_id');
    // }

    // public function clinicalSign()
    // {
    //     return $this->belongsTo(ClinicalSign::class, 'clinical_sign_id');
    // }

    public function animalCat()
    {
        return $this->belongsTo(AnimalCat::class, 'animal_cat_id');
    }
}
