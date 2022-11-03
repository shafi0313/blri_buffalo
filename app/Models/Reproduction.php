<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reproduction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function animalInfo()
    {
        return $this->belongsTo(AnimalInfo::class);
    }

    public function milkProduction()
    {
        return $this->hasMany(Service::class,'animal_info_id','animal_info_id');
    }
}
