<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function index()
    {

        return view('users.auth.signup');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            "email" => "required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/",
            "password" => "required|min:6|confirmed",
            "password_confirmation" => "required",
        ], [
            'username.required' => 'User Name* field is required.',
            'email.required' => 'Email Address* field is required.',
            'password.required' => 'Password field is required.',
            'password_confirmation.required' => 'Confirm Password field is required.',
        ]);

        $newUser = new User();
        $newUser->name = $request->username;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);

        // dd($newUser);
        $newUser->save();
        // return response()->json([
        //     'msg' => 'New user created',
        //     'userInfo' => $newUser,
        //     'token' => $newUser->createToken('user-register')->plainTextToken

        // ]);
        return redirect()->route('user.login')->with('UserRegistered', 'You are registered. Login to continue')->withInput();
    }
}
