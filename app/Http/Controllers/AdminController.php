<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function dashboard()
    {
        $users = User::where(['status'=>false])->get();
        return view('dashboard-admin',compact('users'));
    }

    public function post(Request $request)
    {
        $rules = [
            'caption' => ['required'],
            'image' => 'image'
        ];
        $message = [
            'caption.required' => "You don't have any message to post."
        ];
        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        if($request->image){
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images/posts',auth()->id()."/".$fileName,'public');
        }

        auth()->user()->posts()->create([
            'caption' => $validator->validated()['caption'],
            'image' => $fileName ?? null,
            'roles_id'=> auth()->user()->roles_id
        ]);

        return redirect()->back()->with('message',"Your post has been published to the community");

    }

    public function image($email)
    {
        $user = User::where(['email'=>$email])->first();
        return view('user-id', compact('user'));
    }

    public function announcement()
    {
        $posts = Post::where(['roles_id'=>auth()->user()->roles_id])->orderBy('created_at','desc')->get();
        return view('announcement-admin',compact('posts'));
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

    public function statistics()
    {
        return view('statistics-admin');
    }
}
