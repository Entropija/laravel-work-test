<?php

namespace App\Http\Controllers;

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
        if (Auth::user()->is_manager){
            return redirect()->route('homeManager');
        } else {
            return redirect()->route('homeUser'); 
        }
    }

    public function homeUser()
    {
        return view('home');
    }

    public function homeManager()
    {
        
        return view('manager');
    }


}

