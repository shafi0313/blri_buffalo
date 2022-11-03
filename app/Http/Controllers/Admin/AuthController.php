<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function laraDashboard()
    {
        return redirect()->route('profile.show');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('index');
    }
}
