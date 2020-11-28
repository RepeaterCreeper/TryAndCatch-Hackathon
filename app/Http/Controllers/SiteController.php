<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        if(auth()->user()->status == false){
            \Auth::logout();
            return redirect()->back();
        }

        if(auth()->user()->roles_id === 1)
            return view('dashboard-admin');
        if(auth()->user()->roles_id === 2)
            return view('dashboard-user');
    }

    public function control()
    {
        if(auth()->user()->status == false){
            \Auth::logout();
            return redirect()->route("site.statistics")->with('error','Your account is not yet validated.');
        }

        if(auth()->user()->roles_id == 2)
            return redirect()->route('user.dashboard');

        if(auth()->user()->roles_id == 1)
            return redirect()->route('admin.dashboard');
    }

    public function announcement()
    {
        $posts = Post::where(['roles_id'=>1,'status'=>true])->get();
        return view('announcement-public',compact('posts'));
    }

    public function statistics()
    {
        return view('statistics');
    }


}
