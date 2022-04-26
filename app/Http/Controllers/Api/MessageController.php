<?php

namespace App\Http\Controllers\Api;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        
        // validazione
        $validator = Validator::make($data, [
            'name' => 'required|string|max:20',
            'lastname' => 'required|string|max:20',
            'content' => 'string|required',
            'email' => 'email|required',
            'apartment_id' => 'exists:apartments,id'
        ]);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "errors" => $validator->errors(),
                "data" => $data
            ], 400);
        }

        $newMessage = new Message();
        if (!empty($data['object'])){
            $newMessage->object = $data['object'];
        }
        $newMessage->name = $data['name'];
        $newMessage->lastname = $data['lastname'];
        $newMessage->content = $data['content'];
        $newMessage->email = $data['email'];
        $newMessage->date = date('Y-m-d H:i:s');
        $newMessage->apartment_id = $data['apartment_id'];
        $newMessage->save();

        return response()->json([
            "success"=>true
        ]);
    }   
}