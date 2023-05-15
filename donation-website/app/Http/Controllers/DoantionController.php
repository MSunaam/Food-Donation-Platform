<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoantionController extends Controller
{
    //

    public function addDonation(Request $request){

        $donation = $request->validate([
            'donor_id' => 'required|integer',
            'receiver_id' => 'required|integer',
            'food_item_id' => 'required|integer',
            'status' => 'string|required',
            'scheduled_pickup_time' => 'required|date',
            'actual_pickup_time' => 'required|date'
        ]);

        $donor_id = $request->donor_id;
        $receiver_id = $request->receiver_id;
        $food_item_id = $request->food_item_id;
        $status = $request->status;
        $scheduled_pickup_time = $request->scheduled_pickup_time;
        $actual_pickup_time = $request->actual_pickup_time;

        $data = [
            'donor_id' => $donor_id,
            'receiver_id' => $receiver_id,
            'status' => $status,
            'scheduled_pickup_time' => $scheduled_pickup_time,
            'actual_pickup_time' => $actual_pickup_time
        ];

        DB::table('donations')->insert($data);
    }
}
