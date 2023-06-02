<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmailVerificationRequest;
use Otp;

class EmailVerificationController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp();
    }

    public function email_verification(EmailVerificationRequest $request)
    {
        $otp2 = $this->otp->validate($request->email, $request->otp);
        if(!$otp2->status)
        {
            return response()->json(['error' => $otp],401);
        }
        $user = User::where('email', $request->email)->first();
        $user->update(['email_verified_at' => now()]);

        $success['success'] = true;
        return response()->json($success, 200);
    }
}
