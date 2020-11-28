<?php

namespace App\Http\Controllers;

use App\Models\CovidCase;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
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


    public function remove(Request $request)
    {
        $post = Post::find($request->id);
        $post->update(['important'=>false]);
        return redirect()->back()->with('message',"Post has been removed to pinned post.");
    }

    public function approve(Request $request)
    {
        $post = Post::find($request->id);
        $post->update(['published'=>true]);
        return redirect()->back()->with('message',"Post has been approved.");
    }

    public function star(Request $request)
    {
        $post = Post::find($request->id);
        $post->update(['important'=>true]);
        return redirect()->back()->with('message',"Post has been added to pinned post.");
    }

    public function approval()
    {
        $posts = Post::where(['published' => false, 'status' => true ])->get();
        return view('dashboard-approval',compact('posts'));
    }

    public function deny(Request $request)
    {
        $post = Post::find($request->id);
        $post->update(['status'=>false]);
        return redirect()->back()->with('message',"Post has been rejected.");
    }

    public function delete(Request $request)
    {
        $post = Post::find($request->id);
        $post->update(['status'=>false]);
        return response(['message'=>"Post has been deleted"]);
    }

    public function update(Request $request)
    {
        $post = Post::find($request->id);
        $post->update(['caption'=>$request->caption]);
        return response(['message'=>"Post has been updated!"]);
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
            'roles_id'=> auth()->user()->roles_id,
            'status'=>true,
            'published'=>true,
            'important'=>false,
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
        $posts = Post::where(['roles_id'=>auth()->user()->roles_id,'status'=>true])->orderBy('created_at','desc')->get();
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
        return view('statistics-admin',[
            'active'=>$active,
            'count'=>$count,
            'recover'=>$recover,
            'total'=>$total,
            'death'=>$deaths,
            'population'=>$population,
            'reports'=>$reports,
        ]);
    }

    public function covidNew(Request $request)
    {
        $rules = [
            'first_name' => 'required|max:200|string',
            'last_name' => 'required|max:200|string',
            'mobile_number' => 'required|digits_between:11,12|numeric',
            'address' => 'required|max:500|string',
            'status' => '',
        ];
        $messages = [
            'required' => 'Please make sure not to leave this empty.',
            'string' => 'Do not put any numerics or symbols',
            'max' => 'These field can only accept maximum of 200 characters',
            'digits_between' => 'Please enter a valid mobile number',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
//            return response(['message'=>'error','errors'=>$validator->errors()],400);
        }
        $validated = array_merge($validator->validated(),[
           'status'=>'infected' //Meaning infected
        ]);
        CovidCase::create($validated);
        return redirect()->back()->with('message','A new case has been added to records.');
    }

    public function addNewCaseView()
    {
        return view('admin-addcase');
    }

    public function updateCaseView()
    {
        $cases = CovidCase::where(['status'=>'infected'])->get();
        return view('admin-updatecase',compact('cases'));
    }

    public function recover(Request $request)
    {
        $case = CovidCase::find($request->id);
        $case->update(['status'=>'recovered']);
        return redirect()->back()->with('message',"The user has been added to recovered records.");
    }

    public function deceased(Request $request)
    {
        $case = CovidCase::find($request->id);
        $case->update(['status'=>'deceased']);

        return redirect()->back()->with('message',"The user has been added to deceased records.");
    }
}
