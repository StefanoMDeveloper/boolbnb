<?php

use Illuminate\Database\Seeder;
use App\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = config('messages');
        foreach ($messages as $message){
            $new_message = new Message();
            $new_message->object = $message['object'];
            $new_message->content = $message['content'];
            $new_message->email = $message['email'];
            $new_message->date = $message['date'];
            $new_message->name = $message['name'];
            $new_message->lastname = $message['lastname'];
            $new_message->apartment_id = $message['apartment_id'];
            $new_message->save();
        }
    }
}
