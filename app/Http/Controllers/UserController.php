<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        if(auth()->user()->roles_id == 1) abort(404);

        if(auth()->user()->status == true){
            $posts = auth()->user()->posts()->where(['published'=>0,'status'=>1])->get();
            return view('dashboard-user',compact('posts'));
        }
        else{
            \Auth::logout();
            return redirect()->back();
        }
    }

    public function cancel(Request $request)
    {
        auth()->user()->posts()->where(['id'=>$request->id])->delete();
        return redirect()->back()->with('message','Your submission has been canceled.');
    }

    public function posts()
    {
        if(auth()->user()->status == true){
            $posts = Post::where(['roles_id'=>2,'published'=>1])->orderBy('created_at','desc' )->get();
            $announcements = Post::where(['roles_id'=>1,'status'=>1])->orderBy('created_at','desc')->limit(2)->get();
            return view('announcement-user',compact('posts'),compact('announcements'));
        }
        else{
            \Auth::logout();
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'caption' => 'required|max:150',
        ];
        $message = [
            'caption.required' => 'There is no message to publish!',
            'caption.max' => 'Your post must not exceed 150 characters',
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $validated = array_merge($validator->validated(),[
            'roles_id' => auth()->user()->roles_id,
            'status' => true,
            'published' => false,
        ]);
        auth()->user()->posts()->create($validated);
        return redirect()->back()->with('message','Your post has been submitted for approval.');
    }
}
