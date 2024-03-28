<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function showForm()
    {
        return view('be.login.form');
    }

    public function dashboard()
    {
        return view('be.dashboard');
    }
    public function login(Request $request)
    {
        // dd($request);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'level' => 1])) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('show.login');
    }
}
