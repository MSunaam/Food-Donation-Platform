<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
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
            'city' => 'required',
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

    public function updateProfile(Request $request){

        if(Auth::attempt(['email' => Auth::user()->email, 'password' => $request->old_password])){
            // Authentication passed...
            $request->validate([
                'name' => 'required|string',
                'phone_number' => 'required|numeric',
                'address' => 'required',
                'city' => 'required',
                'old_password' => ['required', ],
                'password'  => Rule::when($request->password != "" or $request->confirm_password != "" , ['min:8', 'same:confirm_password']),
                'confirm_password'  => Rule::when($request->password != "" or $request->confirm_password != "" , ['min:8', 'same:password'])
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Invalid Password'
            ], 403);
        }

        $id = Auth::user()->id;

        if($request->password != "" and $request->confirm_password != "" and $request->password == $request->confirm_password){

            $password = bcrypt($request->password);
            DB::table('users')
                ->where('users.id', $id)
                ->update([
                    'name' => $request->name,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'city' => $request->city,
                    'password' => $password
                ]);

        }else{

            DB::table('users')
                ->where('users.id', $id)
                ->update([
                    'name' => $request->name,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'city' => $request->city
                ]);

        }

        return response()->json([
            'error' => false,
            'message' => 'Successfully Updated'
        ]);

    }

    public function profileView() {
        return view('users.profileSettings');
    }

    public function deleteAccount(Request $request)
    {

        $email = Auth::user()->email;
        $id = Auth::user()->id;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            $request->validate([
                'password' => 'required',
            ]);

            DB::table('requests')
                ->where('requests.requester_id', $id)
                ->delete();
            DB::table('users')
                ->where('users.id', $id)
                ->delete();

            return redirect('/')->with('message', 'Account Deleted Successfully');

        } else {

            return response()->json([
                'error' => true,
                'message' => 'Invalid Password'
            ], 403);

        }
    }
}
