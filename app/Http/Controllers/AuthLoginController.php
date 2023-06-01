<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AuthLoginRequest;
use App\Notifications\LoginNotification;

class AuthLoginController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $credentials = 
        [
            "email" => $request->email,
            "password" => $request->password
        ];

        if(auth()->attempt($credentials))
        {
            $user = Auth::user();

            $user->tokens()->delete();

            $success['token'] = $user->createToken(request()->userAgent())->plainTextToken;
            $success['name'] = $user->first_name;
            $success['success'] = true;
            $user->notify(new LoginNotification);
            
            return response()->json($success, 200);
        }
        else
        {
            return response()->json
            (
                [
                    'error' => 'Unauthorised'
                ],401
            );
        }
    }
}
