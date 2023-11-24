<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }else{
            return view('pages.auth-login');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect()->back();
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/auth-login');
    }
}
