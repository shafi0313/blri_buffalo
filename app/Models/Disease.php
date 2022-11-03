<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function clinicalSigns()
    {
        return $this->hasMany(ClinicalSign::class, 'disease_id');
    }
}
