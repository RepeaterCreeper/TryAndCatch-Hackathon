<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return $this->verified('dashboard-user');
    }

    public function posts()
    {
        return $this->verified('announcement-user');
    }

    public function verified(string $view)
    {
        if(auth()->user()->status == true)
            return view($view);
        else{
            \Auth::logout();
            return redirect()->back();
        }
    }
}
