<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        $validatedData = $request->validated();

        $user->update($validatedData);

        $user = $user->refresh();

        $success['user'] = $user;
        $success['success'] = true;

        return response()->json($success, 200);
    }
}
