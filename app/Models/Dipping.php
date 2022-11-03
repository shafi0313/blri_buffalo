<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dipping extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function animalInfo()
    {
        return $this->belongsTo(AnimalInfo::class);
    }
}
