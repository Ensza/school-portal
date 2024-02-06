<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    static function login(){
        $credentials = request()->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials, request()->rememberme)) {
            request()->session()->regenerate();
 
            return redirect('/');
        }else{
            return back()->withErrors(['login' => 'Username or Password is incorrect']);;
        }
    }
}
