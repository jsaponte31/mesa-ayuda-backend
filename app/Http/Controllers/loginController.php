<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(Request $request)
    {
        $result = [];
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();

            $result = ['message' => 'Login successful','status' => 200];
        }else{
            $result = ['message' => 'Login failed','status' => 401];
        }

        return $result;
    }
}
