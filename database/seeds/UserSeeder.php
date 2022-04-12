<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = config('users');
        foreach ($users as $user){
            $new_user = new User();
            $new_user->name = $user['name'];
            $new_user->last_name = $user['lastname'];
            $new_user->email = $user['email'];
            $new_user->phone = $user['phone'];
            $new_user->birth_date = $user['birth_date'];
            $new_user->password = $user['password'];
            $new_user->save();
        }
    }
}

