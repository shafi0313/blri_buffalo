<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function animalInfo()
    {
        return $this->belongsTo(AnimalInfo::class);
    }

    public function bullId()
    {
        return $this->belongsTo(AnimalInfo::class, 'bull_id');
    }

    public function getFarmInfo()
    {
        return $this->belongsTo(Farm::class, 'farm_id');
    }

    public function getCommunityInfo()
    {
        return $this->belongsTo(CommunityCat::class, 'community_cat_id');
    }
}
