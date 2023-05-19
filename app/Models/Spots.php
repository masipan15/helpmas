<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\spot_vaccines;

class Spots extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function regional()
    {
        return $this->belongsTo(Regional::class, 'regional_id', 'id');
    }
    public function spot_vaccine()
    {
        return $this->hasMany(spot_vaccines::class,'spot_id');
    }
}
