<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseSign extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function animalInfo()
    {
        return $this->belongsTo(AnimalInfo::class);
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_id');
    }

    public function clinicalSign()
    {
        return $this->belongsTo(ClinicalSign::class, 'clinical_sign_id');
    }
}
