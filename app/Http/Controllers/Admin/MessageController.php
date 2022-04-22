<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
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
 
        $messages = [];
        
        $apartments = Apartment::all()->where('user_id', $user_id);

        $messagesList = Message::all();

        foreach ($apartments as $apartment) {
            foreach ($messagesList as $message) {
                if($message['apartment_id'] == $apartment['id']){
                    array_push($messages, $message);
                }
            }
        }
        $messages = collect($messages)->sortBy('date')->reverse();
        return view('admin.messages', compact('messages'));
    }
}
