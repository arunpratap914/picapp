<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FrontController extends Controller
{
    public function index()
    {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin_dashboard');
        } else if (Auth::user()->is_admin == 0) {
            return redirect()->route('user_groups');
        }
        return view('home');
    }
}
