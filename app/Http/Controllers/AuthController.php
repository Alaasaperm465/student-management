<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ForgotPasswordMail;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Str;

class AuthController extends Controller
{
    //
    public function login(Request $request){
                
        return view('Auth.login');

    }
    public function login_post(Request $request){

        if(Auth::attempt(['email'=>$request->email, 'password' => $request->password],true)){
            // Check user role and redirect accordingly
            if(Auth::user()->role === 'admin'){
                return redirect()->route('admin.dashboard');
            }else if(Auth::user()->role === 'user'){
                return redirect()->route('user.courses');
            }else{
                return redirect()->route('login')->with('error', 'Invalid role');
            }
        }else{
            return redirect(url('/'))->with('error', 'Invalid email or password');
        };

    }
    public function showRegistrationForm(){

        
        echo view('Auth.register');

    }
        public function register(Request $request)
        {
            $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role for new registrations
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully.');
    }
    public function forgot(Request $request){

        echo view('Auth.forgot');

    }
    public function forgot_pass(Request $request){

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }}