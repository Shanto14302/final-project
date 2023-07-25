<?php

namespace App\Http\Controllers;

use App\Models\Admin\AdminProfile;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
        
        return view('home');
    }
}
