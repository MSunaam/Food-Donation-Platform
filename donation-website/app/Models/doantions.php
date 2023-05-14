<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doantions extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'reciever_id',
        'food_item_id',
        'status',
        'scheduled_pickup_time',
        'actual_pickup_time'
    ];

}
