<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'caption' => ['required'],
            ''
        ];
        auth()->user()->posts()->create();
    }
}
