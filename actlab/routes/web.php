<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/contact',function(){
    return view('Contact', ['name' => 'John']);
});

Route::get('/about', [PostController::class, 'display']);
Route::get('/details', [PostController::class, 'display']);

// Route::get('/details', [StudentController::class, 'display']);
Route::get('/details/{id}', [StudentController::class, 'display']);
Route::get('/details1', [PostController::class, 'display']);
