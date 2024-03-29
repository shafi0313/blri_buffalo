<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeadCulled extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function animalInfo()
    {
        return $this->belongsTo(AnimalInfo::class, 'animal_info_id', 'id');
    }
}
