<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'requester_id',
        'food_category',
        'quantity',
        'unit',
        'request_date',
        'status',
        'notes',
    ];

}
