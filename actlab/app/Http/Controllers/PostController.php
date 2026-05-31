<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function display(){
        return view('about');
    }

    public function details(){
        return view('admin.details');
    }

    public function display1(){
        $values = array();
        $values ['name1'] = 'Leo';
        $values ['name2'] = 'Gab';
        return view ('contact', ['students' => $values, 'name' => 'LV']);
    }
}

