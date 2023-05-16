<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    //

    public function requestView(){

        $history = DB::table('requests')->get();

        return view('users.foodBank.request', ['history' => $history]);
    }

    public function getRequests(Request $request){

        $id = Auth::user()->id;

        $requestHistory = DB::table('requests')
        ->select('requests.id', 'users.name', 'requests.food_category', 'requests.quantity','requests.request_date', 'requests.status')
        ->join('users', 'users.id', '=', 'requests.requester_id')
        ->where('requests.requester_id', '=', $id)
        ->get();

        if($request->ajax()){
            return ['requestHistory' => $requestHistory];
        }
        return response()->json([
            "error" => true,
            "message" => "Invalid Request"
        ]);

    }
    public function addRequest(Request $request){

        $id = Auth::user()->id;
        $request_date = Carbon::now()->toDateString();
        $created_at = Carbon::now()->toDateString();

        $request->validate([
            'food_category' => 'required',
            'quantity' => 'required|numeric|min:1',
            'unit' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'requester_id' => $id,
            'food_category' => $request->food_category,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'request_date' => $request_date,
            'status' => $request->status,
            'created_at' => $created_at,
        ];

        DB::table('requests')->insert($data);

        return response()->json([
            "error" => false,
            "message" => "Successfully Entered Data"
        ]);
    }

}
