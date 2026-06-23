<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'facebook',
        'instagram',
        'twitter',
        'week_hours',
        'sat_hours',
        'logo',
        'cover_photo',
        'hero_title',
        'hero_subtitle',
    ];
}