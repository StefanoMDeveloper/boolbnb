<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::where("id", $id)->with(["apartments"])->first();
        return response()->json($user);
    }
}