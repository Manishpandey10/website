<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('users.auth.login');
    }
    public function verifyLogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'Enter Email field is required',
                'email.email' => 'Input is not type of email',
                'password.required' => "Enter password field is required."
            ]
        );
         if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if (Auth::user()->role_id == 2) {
                return redirect()->intended(route('home'))->with('UserLogin', 'Welcome Back user, continue shopping...');
            } else {

                Auth::logout();
              
                return redirect()->route('user.login')->with('NotUser', "Login failed.");
            }
        } else {
      
            return redirect()->back()->with('loginError', 'Wrong credentials, Please enter correct credentials.');
        }

    }
    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('user.login')->with('userLogout', `You're logged out user.`);
    }
}
