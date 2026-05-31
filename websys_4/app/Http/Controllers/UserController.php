<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
 public function create(){
    return view('registration');
 }
 public function store(Request $r){
    $validated =$r -> validate([
        'name' => 'required|min:3|max:50',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ],
    [
        'name.required' => $r->name . 'Your full Name is required.',
        'name.min' =>$r->name . 'Full Name must be greater than 3 required.',
        'email.email' => $r->email.'Please enter valid email address.'
    ]
    );
    return back()->with ('success','Registration successful');
 }
}
