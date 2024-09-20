<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_title',
        'promo_content',
        'promo_subcontent',
        'promo_restriction',
        'promo_capa',
        'promo_status',
        'promo_btn_title',
        'promo_btn_link'
    ];
}
