<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login(LoginRequest $data){
        $credentials = [
            'email' => $data->user_email,
            'password' => $data->user_password,
        ];
        //attemp login
        if(!Auth::attempt($credentials)){
            return redirect()->back()->with('invalid_admin_login',1);
        }else{
            return redirect()->route('home')->with('admin_login_success',1);
        }
    }

    public function Logout(){
        Auth::logout();
        return redirect('/')->with('admin_logout_success',1);
    }
}
