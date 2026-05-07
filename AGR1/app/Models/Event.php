<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date_start',
        'date_end',
        'location',
        'banner_image',
        'status',
    ];
}