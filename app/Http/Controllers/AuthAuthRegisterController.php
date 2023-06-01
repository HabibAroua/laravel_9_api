<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use App\Http\Requests\AuthRegistrationRequest;

class AuthAuthRegisterController extends Controller
{
    public function register(AuthRegistrationRequest $request)
    {
        $newuser = $request->validated();

        $newuser['password'] = Hash::make($newuser['password']);
        $newuser['role'] = 'user';
        $newuser['status'] = 'active';

        $user = User::create($newuser);

        $success['token'] = $user->createToken('user', ['app:all'])->plainTextToken;
        $success['name'] = $user->first_name;
        $success['success'] = true;

        return response()->json($success, 200);
    }
}
