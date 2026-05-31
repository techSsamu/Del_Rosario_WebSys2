<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::get('/', function(){
    return view ('home');
});

Route::get('/about', function(){
    return view ('about');
});

Route::get('/register', [UserController:: class, 'create']);
Route::post('/register', [UserController:: class, 'store']) -> name('register.store');
