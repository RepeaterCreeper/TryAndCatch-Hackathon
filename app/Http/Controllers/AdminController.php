<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $users = User::where(['status'=>false])->get();
        if(auth()->user()->roles_id == 1)
            return view('dashboard-admin',compact('users'));
        else
            \Auth::logout();
        return redirect()->back();
    }

    public function image($email)
    {
        $user = User::where(['email'=>$email])->first();
        return view('user-id', compact('user'));
    }

    public function announcement()
    {
        return $this->show('announcement-admin');
    }

    public function add(User $user)
    {
        $user->update(['status'=>true]);
        return redirect()->route('admin.dashboard')->with('message',"User has been added successfully!");
    }

    public function reject(User $user)
    {
        //Maybe just store them in a separate database? before deletion, to keep the records..
        $user->delete();
        return redirect()->route('admin.dashboard')->with('message',"User has been deleted successfully!");
    }

    private function show(string $view)
    {
        if(auth()->user()->roles_id == 1)
            return view($view);
        else
            \Auth::logout();
        return redirect()->back();
    }

    public function statistics()
    {
        return "Hello";
    }
}
