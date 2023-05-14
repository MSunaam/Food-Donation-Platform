<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_name',
        'food_category',
        'expiration_date',
        'quantity',
        'unit',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

}
