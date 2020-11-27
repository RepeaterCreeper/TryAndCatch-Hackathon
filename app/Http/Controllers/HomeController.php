<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if(auth()->user()->status == false){
            \Auth::logout();
            return redirect()->back();
        }

        if(auth()->user()->roles_id === 1)
            return view('dashboard-admin');
        else
            return view('dashboard');
    }
}
