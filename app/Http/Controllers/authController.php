<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class authController extends Controller
{
    function redirect() 
    {
        return Socialite::driver('google')->redirect();
    }
    function callback()
    {
        $user = Socialite::driver('google')->user();
    $id = $user->id;
    $email = $user->email;
    $name = $user->name;

    return "$id - $email - $name";
    }
}
