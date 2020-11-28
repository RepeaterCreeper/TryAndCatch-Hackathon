<?php

namespace App\Http\Controllers;

use App\Models\CovidCase;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
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
        $actives = CovidCase::where(['status'=>'infected'])->get();
//        dd($actives);
        $count = 0;
        foreach ($actives as $active) {
            $diff=date_diff($active->created_at->toDate(),Carbon::now()->toDate());
            if(intval($diff->format('%a')) <= 0) $count++; //less than 24 hrs / 1 day
        }
        $active = $actives->count();
        $recover = CovidCase::where(['status'=>'recovered'])->count();
        $deaths = CovidCase::where(['status'=>'deceased'])->count();
        $total = CovidCase::all()->count();
        $population = User::where(['status'=>true])->get()->count();
        $reports = Report::where(['calamities_id'=>1])->get();
        return view('statistics',[
            'active'=>$active,
            'count'=>$count,
            'recover'=>$recover,
            'total'=>$total,
            'death'=>$deaths,
            'population'=>$population,
            'reports'=>$reports,
        ]);
    }


}
