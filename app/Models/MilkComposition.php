<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkComposition extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function animalInfo()
    {
        return $this->belongsTo(AnimalInfo::class);
    }
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
    public function communityCat()
    {
        return $this->belongsTo(CommunityCat::class);
    }
}
