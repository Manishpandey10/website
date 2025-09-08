<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function index(){
        return view('admin.profile.changePassword');
    }
    public function update(Request $request){
         $request->validate([
            'cur_password' => 'required|min:6',
            'new_password' => 'required|min:6', 
            'password_confirmation' => 'required|same:new_password',
        ], [
            'cur_password.required' => 'Current password field is required',
            'cur_password.min' => 'Password should be atleast 6 characters long',
            'new_password.required' => 'New password field is required',
            'new_password.min' => 'Password should be atleast 6 characters long',
            'password_confirmation.required' => 'Please confirm your new password',
            'password_confirmation.same' => 'Confirm Password and New Password values does not match',
        ]);
    }
}
