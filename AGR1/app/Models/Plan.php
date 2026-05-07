<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'min_amount',
        'benefits',
        'badge_image',
        'card_color',
        'display_order',
        'status',
    ];
}