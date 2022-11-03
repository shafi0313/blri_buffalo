<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalCat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subCat()
    {
        return $this->hasMany(AnimalCat::class, 'parent_id', 'id');
    }
}
