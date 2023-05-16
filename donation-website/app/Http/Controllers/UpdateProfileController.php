<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateProfileController extends Controller
{
    public function updateProfile(Request $request){

        $request->validate([
            'name' => 'required|exists:donations,id',
            'old_password' => 'required|password',
            'new_password' =>'required|password',
            'confirm_password' =>'required|password|confirmed',
            'address' =>'required|text, min:3',
            'city' =>'required|text, min:3',
            'phone_number' =>'required',


        ]);

        $id = $request->auth('user_id'); // Replace 6 with the desired donation ID

        $updateData = [
            'name' => $request->name,
            'password' => $request->confirm_password, 
            'address' => $request->address, 
            'city' => $request->city, 
            'phone_number' => $request->phone_number, 
        ];

        $response = DB::table('users')
            ->where('id', $id)
            ->update($updateData);


            return response()->json([
                'error' => false,
                'message' => 'Success'
            ]);

    }

}