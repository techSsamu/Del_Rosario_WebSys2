<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| All routes use Route::get
| No controllers are used
| All data comes from URL parameters
*/

/*
|--------------------------------------------------------------------------
| Problem 1: Student Profile Page
|--------------------------------------------------------------------------
| Example:
| /student/2025/Maria
| /student/2025
*/

Route::get('/student/{id}/{name?}', function ($id, $name = "Guest Student") {

    return view('student.profile', [
        'studentId' => $id,
        'studentName' => $name
    ]);

});


/*
|--------------------------------------------------------------------------
| Problem 2: Course Enrollment Page
|--------------------------------------------------------------------------
| Example:
| /course/BSIT/3
| /course/BSIT
*/

Route::get('/course/{course}/{year?}', function ($course, $year = "1st Year") {

    return view('course.enrollment', [
        'courseName' => $course,
        'yearLevel' => $year
    ]);

});


/*
|--------------------------------------------------------------------------
| Problem 3: OJT Company Information Page
|--------------------------------------------------------------------------
| Example:
| /ojt/ABC/Manila/Yes
| /ojt/ABC/Manila
*/

Route::get('/ojt/{company}/{city}/{allowance?}', function ($company, $city, $allowance = "No") {

    return view('ojt.company', [
        'companyName' => $company,
        'cityName' => $city,
        'allowanceStatus' => $allowance
    ]);

});

/*
|--------------------------------------------------------------------------
| Problem 4: Event Registration Page
|--------------------------------------------------------------------------
| Example:
| /event/Workshop/Juan/2
*/

Route::get('/event/{event}/{participant}/{year}', function ($event, $participant, $year) {

    return view('event.registration', [
        'eventName' => $event,
        'participantName' => $participant,
        'yearLevel' => $year
    ]);

});