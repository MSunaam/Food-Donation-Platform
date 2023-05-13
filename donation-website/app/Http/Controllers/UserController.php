<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function register() {
        return view('users.register');
    }
    public function create(Request $request) {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password'=> 'required|min:8|max:15',
            'confirm_password' => 'required|same:password',
            'address' => 'required',
            'phone_number' => 'required|numeric',
            'user_type' => 'required|in:groceryStore,restaurant,foodBank',
        ]);

        //Hashing
        $formFields['password'] = bcrypt($formFields['password']);

        //Create User
        $user = User::create($formFields);

        //Login User
        auth()->login($user);

        //Redirect
        return redirect()->route('dashboard')
            ->with('message', 'User Created Successfully')
            ->with('user', $user);


    }
}
