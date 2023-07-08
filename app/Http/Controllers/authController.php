<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        $user = User::updateOrCreate(
            ['email'=> $email],
            [
                'name' => $name,
                'google_id' => $id
                
            ]    
        );

    }
}
