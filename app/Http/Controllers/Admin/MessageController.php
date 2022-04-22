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
        
        // $actual = Message::all();
        // $makeComparer = function($criteria) {
        //     $comparer = function ($first, $second) use ($criteria) {
        //       foreach ($criteria as $key => $orderType) {
        //         // normalize sort direction
        //         $orderType = strtolower($orderType);
        //         if ($first[$key] < $second[$key]) {
        //           return $orderType === "asc" ? -1 : 1;
        //         } else if ($first[$key] > $second[$key]) {
        //           return $orderType === "asc" ? 1 : -1;
        //         }
        //       }
        //       // all elements were equal
        //       return 0;
        //     };
        //     return $comparer;
        //   };

        // $criteria = ["date" => "desc"];
        // $comparer = $makeComparer($criteria);
        // $sorted = $actual->sort($comparer);
        // $messages = $sorted->values()->toArray();
        
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
