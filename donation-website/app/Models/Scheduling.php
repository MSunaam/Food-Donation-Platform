<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduling extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'donor_id',
        'reciever_id',
        'status',
        'pickup_date',
        'pickup_time',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

}
