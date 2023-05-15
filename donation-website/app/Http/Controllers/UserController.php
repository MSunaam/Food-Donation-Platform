<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;

class UserController extends Controller implements MustVerifyEmail
{
    //
    use Notifiable;
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

    //logout
    public function logout(Request $request){

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logged Out Successfully');
    }

    public function login() {
        return view('users.login');
    }

    public function authenticate(Request $request) {

        $formFields = $request->validate([
            'password' => 'required',
            'email' => ['required', 'email']
        ]);

        if(auth()->attempt($formFields)){

            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('message', 'Successfully Logged In');
        }else {
            return response()->json([
                "error" => true,
                "message" => "Invalid Credentials"
            ], 403);
        }
//        return back()->withErrors(['email'=>'invalid credentials'])->onlyInput('email');

    }

    public function hasVerifiedEmail()
    {
        // TODO: Implement hasVerifiedEmail() method.
    }

    public function markEmailAsVerified()
    {
        // TODO: Implement markEmailAsVerified() method.
    }

    public function sendEmailVerificationNotification()
    {
        // TODO: Implement sendEmailVerificationNotification() method.
    }

    public function getEmailForVerification()
    {
        // TODO: Implement getEmailForVerification() method.
    }
}
