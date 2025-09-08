<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
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

            if (Auth::user()->role_id == 1) {
                // return response()->json([
                //     'msg' => "login success for admin",
                //     'userinformation' => $user,
                //     'token' => $user->createToken('Admin-login-token')->plainTextToken

                // ]);
                return redirect()->route('admin.dashboard')->with('AdminLogin', 'Welcome to the dasboard admin...');
            } else {

                Auth::logout();
                // return response()->json([
                //     'msg' => "you are not a admin",
                // ]);
                return redirect()->route('admin.login')->with('NotAdmin', "You are not admin, cannot access this page.");
            }
        } else {
            // return response()->json([
            //     'msg' => 'Wrong credential entered, please enter correct credentials!!'
            // ]);
            return redirect()->back()->with('loginError', 'Wrong credentials, Please enter correct credentials.');
        }
    }
    public function adminLogout()
    {
        // $user = Auth::user();
        // $token =$user->currentAccessToken() ;
        // if($token){
        //     $token->delete();
        // }
        

        // return response()->json([
        //     'msg' => 'User is logged out successfully',
        //     'token status' => "Deleted",
        // ]);
        
        Auth::logout();
        return redirect()->route('admin.login')->with('AdminLogout', 'You are succesfully logged out!');
    }
}
