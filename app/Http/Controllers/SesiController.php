<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index() {
        return view('login');
    }

    function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'emial.required' => 'Email is required',
            'password.required' => 'Password is required'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/welcome/admin');
            } elseif (Auth::user()->role == 'staff') {
                return redirect('/welcome/staff');
            } else {
                return redirect('/welcome/supervisor');
            }
        } else {
            return redirect('')->withErrors('The email and password entered do not match')->withInput();
        }
    }

    function logout() {
        Auth::logout();
        return redirect('');
    }

    function error() {
        return view('errors.404');
    }
}
