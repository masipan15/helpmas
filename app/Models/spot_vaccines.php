<?php

namespace App\Models;

use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class spot_vaccines extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class, 'vaccine_id', 'id');
    }

}
