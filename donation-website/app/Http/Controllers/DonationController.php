<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    //

    public function newDonation(Request $request){

        $donation = $request->validate([
            'donor_id' => 'required|integer|exists:users,id',
            'request_id' => 'required|integer|exists:requests,id',
            'quantity' => 'required|integer',
            'scheduled_pickup_time' => 'required|date',
            'food_name' => 'required',
        ]);

        $requestDetails = DB::table('requests')
            ->select('requests.id', 'requester_id', 'requests.food_category', 'requests.quantity','requests.request_date', 'requests.status', 'notes')
            ->where('requests.id', '=', $request->request_id)
            ->get();

        DB::table('donations')
            ->insert([
                'donor_id' => $request->donor_id,
                'receiver_id' => $requestDetails[0]->requester_id,
                'food_category' => $requestDetails[0]->food_category,
                'status' => 'scheduled',
                'scheduled_pickup_time' => $request->scheduled_pickup_time,
                'created_at' => Carbon::now()->toDateString(),
                'food_name' => $request->food_name,
            ]);

        DB::table('requests')
            ->where('id', '=', $request->request_id)
            ->update([
                'status' => 'partially_fulfilled',
            ]);

        return response()->json([
            "error" => false,
            "message" => $requestDetails,
        ]);

    }

    public function addDonation(Request $request){

        $donation = $request->validate([
            'donor_id' => 'required|integer|exists:users,id',
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
        $created_at = Carbon::now()->toDateString();

        $data = [
            'donor_id' => $donor_id,
            'receiver_id' => $receiver_id,
            'status' => $status,
            'scheduled_pickup_time' => $scheduled_pickup_time,
            'food_name' => $food_name,
            'food_category' => $food_catgeory,
            'created_at' => $created_at,
        ];

        DB::table('donations')->insert($data);

        return response()->json([
            "error" => false,
            "message" => "Successfully Entered Data"
        ]);

    }

    public function markComplete(Request $request){

        $updated_at = Carbon::now()->toDateString();

        $request->validate([
            'donation_id' => 'required|exists:donations,id',
            'status' => 'required|in:completed,scheduled,cancelled',
            'actual_pickup_time' =>'required|date'
        ]);

        $id = $request->donation_id; // Replace 6 with the desired donation ID

        $updateData = [
            'status' => $request->status,
            'actual_pickup_time' => $request->actual_pickup_time, // Replace with the desired actual pickup time
            'updated_at' => $updated_at
        ];

        $response = DB::table('donations')
            ->where('id', $id)
            ->update($updateData);


            return response()->json([
                'error' => false,
                'message' => 'Success'
            ]);

    }

    public function donationHistory(Request $request){

        $id = Auth::user()->id;

        $donations = DB::table('donations')
            ->select('donations.id', 'users.name as donor_name', 'donations.food_name', 'donations.food_category', 'donations.status', 'donations.scheduled_pickup_time')
            ->join('users', 'users.id', '=', 'donations.donor_id')
            ->where('donations.receiver_id', $id)
            ->get();


        if($request->ajax()){
            return ['donations' => $donations];
        }

        return view('users.donationHistory', compact('donations'));

    }

}
