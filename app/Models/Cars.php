<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = [
        'carModel',
        'tags',
        'available',
        'description',
        'rental_price_per_day',
        'user_id',
        'location_id'
    ];
}
