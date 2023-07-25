<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function GetLogo(){
        return view('admin.user.logo');
    }
}
