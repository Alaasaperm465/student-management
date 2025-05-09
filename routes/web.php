<?php

use App\Http\Controllers\batchController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layout');
});

Route::resource('students'          , studentController::class,);

Route::resource('teachers'          , TeacherController::class,);

Route::resource('courses'           , courseController::class);

Route::resource('batches'           , batchController::class);

Route::resource('enrollments'       , EnrollmentController::class);

Route::resource('payments'          , PaymentController::class);


Route::get('report/report1/{pid}',[ResultController::class , 'report2']);


