<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'loc_name',
        'loc_phone',
        'loc_address',
        'loc_resume',
        'loc_images'
    ];
}
