<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function communityCat()
    {
        return $this->belongsTo(CommunityCat::class, 'community_cat_id');
    }

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
    public function animals(){
        return $this->hasMany(AnimalInfo::class, 'community_cat_id','id');
    }
}
