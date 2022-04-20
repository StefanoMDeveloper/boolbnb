<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
        $user_id=Auth::user()->id;
        // $messages=Message::orderBy('date', 'ASC')
        // ->pluck('date')
        // ->map(function($date) {
        //   return $date->format("d-m-Y");
        // })->unique();
        $apartments = Apartment::all()->where('user_id', $user_id);
        return view('admin.profile', compact('apartments'));
    }
}
