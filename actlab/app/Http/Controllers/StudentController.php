<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // public function display1(){
    //     return view('student', ['name1' => 'leo', 'name2' => 'gab', 'name3' => 'gabriel',]);
    // }

    public function display($id){
        return view('student') -> with('id', $id);
    }
}
