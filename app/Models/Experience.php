<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'image',
        'date',
        'location',
        'price',
        'is_premium',
    ];

    protected $casts = [
        'date' => 'datetime',
        'is_premium' => 'boolean',
        'price' => 'decimal:2',
    ];
}
