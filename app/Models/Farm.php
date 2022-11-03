<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }
}
