<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Image;
use App\Group;
use App\Group_user;
use App\Group_image;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // var_dump(Auth::user()->id);
        // die;
        if (Auth::user()->id) {
            return redirect()->route('user_groups');
        }
        return view('home');
    }

    public function user_groups()
    {
        $user = User::find(Auth::user()->id);
        return view('user_groups', ['user' => $user]);
    }
    public function group(Request $request)
    {
        $group = Group::find($request->id);
        return view('group_detail', ['group' => $group]);
    }
}
