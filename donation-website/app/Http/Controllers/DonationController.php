<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    //

    public function addDonation(Request $request){

        $donation = $request->validate([
            'donor_id' => 'required|integer',
            'receiver_id' => 'required|integer|different:donor_id',
            'food_name' => 'required',
            'food_category' => 'required',
            'status' => 'string|required',
            'scheduled_pickup_time' => 'required|date',
        ]);

        $donor_id = $request->donor_id;
        $receiver_id = $request->receiver_id;
        $food_name = $request->food_name;
        $food_catgeory = $request->food_category;
        $status = $request->status;
        $scheduled_pickup_time = $request->scheduled_pickup_time;

        $data = [
            'donor_id' => $donor_id,
            'receiver_id' => $receiver_id,
            'status' => $status,
            'scheduled_pickup_time' => $scheduled_pickup_time,
            'food_name' => $food_name,
            'food_category' => $food_catgeory
        ];

        DB::table('donations')->insert($data);

        return response()->json([
            "error" => false,
            "message" => "Successfully Entered Data"
        ]);

    }
}
