<?php

use App\Http\Controllers\batchController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\DashboardController;
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

Route::get('/'          ,[AuthController::class , 'login'])                 ->name('login');
Route::post('/login_post'          ,[AuthController::class , 'login_post'])     ->name('login_post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot'    ,[AuthController::class , 'forgot'])    ->name('forgot_account');
Route::post('/forgot_pass'    ,[AuthController::class , 'forgot_pass'])    ->name('forgot_pass');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register_post', [AuthController::class, 'register'])->name('register_post');


// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('students'          , studentController::class);
    Route::resource('teachers'          , TeacherController::class);
    Route::resource('courses'           , courseController::class);
    Route::resource('batches'           , batchController::class);
    Route::resource('enrollments'       , EnrollmentController::class);
    Route::resource('payments'          , PaymentController::class);
});

// User Routes
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/user/courses');
    })->name('user.dashboard');
    
    Route::get('/user/courses', function () {
        return view('user.courses');
    })->name('user.courses');
    
    Route::get('/user/enrollments', function () {
        return view('user.enrollments');
    })->name('user.enrollments');
});

Route::get('report/report1/{pid}',[ResultController::class , 'report2']);



