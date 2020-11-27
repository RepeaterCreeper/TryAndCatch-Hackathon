<?php

namespace App\Http\Controllers;

use App\Models\AccountRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountRequestController extends Controller
{
    public function request(Request $data)
    {
        $validator = Validator::make($data->toArray(), [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'address' => ['required', 'string', 'max:500'],
            'valid_id' => ['required','image'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'digits_between:11,12', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

         AccountRequest::create([
            'first_name' => $data['first_name'],
            'roles_id' => 1,
            'middle_name' => $data['middle_name'] ?? "",
            'last_name' => $data['last_name'],
            'birthdate' => $data['birthdate'],
            'address' => $data['address'],
            'valid_id' => $data['valid_id'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
        ]);
         session()->flash('message','User registered successfully');
         return redirect()->back();
    }
}
