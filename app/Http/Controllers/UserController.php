<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use DateTimeZone;
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
            $posts = auth()->user()->posts()->where(['published'=>0])->get()->sortByDesc('status');
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
            'important' => false,
        ]);
        auth()->user()->posts()->create($validated);
        return redirect()->back()->with('message','Your post has been submitted for approval.');
    }

    public function report()
    {
        $user = auth()->user()->reports->last();
        if($user){
            $dateDiff = date_diff($user->created_at->toDateTime(),Carbon::now()->toDateTime());
            if($dateDiff->h < 2){
                return redirect()->back()->with('error','You can only report once per 2 hours');
            }
        }
        //For now power outage onlu
        auth()->user()->reports()->create([
            'calamities_id'=>1
        ]);
        return redirect()->back()->with('message','Your report has been sent.');
    }

    public function appointmentShow()
    {
        $data = auth()->user()->appointment()->get();
        return view('appointment-user',compact('data'));
    }

    public function appointmentStore(Request $request)
    {
        $rules = [
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ];
        $message = [
            'date.required' => 'You need to set a date for your appointment',
            'time.required' => 'Time is needed for your appointment',
            'date.date' => 'This field must be a valid date',
            'time.time' => 'It looks like, you haven\'t set the time.',
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }

        $date = Carbon::parse($request->date." ".$request->time);
        auth()->user()->appointment()->create([
            'schedule'=>$date,
            'status'=>'pending',
        ]);
        return redirect()->back()->with("message",'Appointment has been set successfully');
    }

    public function documentShow()
    {
        if(auth()->user()->roles_id == 1) abort(404);
        return view('document-user');
    }

    public function simpleDocument(Request $request)
    {

        $rules = [
            'full_name' => 'required|string|max:250|min:2',
            'type' => 'required|string|max:250|min:2',
            'purpose' => 'required|string|max:500|min:5',
        ];

        if($request->type == "certguardianship"){
            $rules['guardian_name'] =  'required|string|max:250|min:2';
        }
        if($request->type == "brgclearance"){
            $rules['title'] =  'required|string';
            $rules['civil_status'] =  'required|string';
            $rules['age'] =  'required|numeric';
            $rules['residence_number'] =  'required|numeric';
        }
        if($request->type == "brgclearance_businesspermit"){
            $rules['residence_number'] =  'required|numeric';
            $rules['business_type'] =  'required|string';
            $rules['business_location'] =  'required|string';
            $rules['business_ownership'] =  'required|string';
            $rules['business_ownership_other'] =  'string';
            $rules['sketch_map'] =  'image';
            $rules['age'] =  'required|numeric';
            $rules['residence_number'] =  'required|numeric';
            $rules['contact_number'] =  ['required', 'numeric', 'digits_between:11,12'];
        }

        $message = [
            'full_name.required' => 'Please do not leave the the full name empty',
            'full_name.max' => 'Full name can only contains 2-250 characters',
            'full_name.min' => 'Full name can only contains 2-250 characters',
            'civil_status.required' => 'Please do not leave the the civil status field empty',
            'civil_status.max' => 'Civil status can only contains 2-250 characters',
            'civil_status.min' => 'Civil status can only contains 2-250 characters',
            'guardian_name.required' => 'Please do not leave the the Guardian name empty',
            'guardian_name.max' => 'Guardian name can only contains 2-250 characters',
            'guardian_name.min' => 'Guardian name can only contains 2-250 characters',
            'type.required' => 'Please do not leave the the type field empty',
            'type.max' => 'Type field can only contains 2-250 characters',
            'type.min' => 'Type field can only contains 2-250 characters',
            'purpose.required' => 'Please do not leave the the purpose field empty',
            'purpose.max' => 'Purpose field can only contains 5-500 characters',
            'purpose.min' => 'Purpose field can only contains 5-500 characters',
            'string' => 'All of this field must include a letter/characters',
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        auth()->user()->document()->create($validator->validated());

        return redirect()->back()->with("message","Your request for the document has been sent.");
    }

    public function supportUser()
    {
        if(auth()->user()->roles_id == 1) abort(404);
        $messages = auth()->user()->message->sortBy('created_at');
        return view('support-user',compact('messages'));
    }

    public function messageStore(Request $request)
    {
        if(auth()->user()->roles_id == 1) abort(404);

        $request->validate([
            'message'=>"required",
        ]);
        auth()->user()->message()->create([
            'message'=>$request->message,
            'email' => auth()->user()->email
        ]);
        return redirect(route('admin.support')."#here")->with('success','Message Sent!');
    }
}
