<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Societies extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $guarded = [];

    public function regional()
    {
        return $this->belongsTo(Regional::class, 'regional_id', 'id');
    }
}
