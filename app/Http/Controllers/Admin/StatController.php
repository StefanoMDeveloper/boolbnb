<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Apartment;
use App\Stat;

use Illuminate\Support\Facades\Auth;

class StatController extends Controller
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
        $stats = Stat::all();
        $user_id = User::all();
        $apartments = Apartment::all()->where('user_id', $user_id);
        return view('admin.stats.index', compact('user_id','apartments','stats'));
    }
}
