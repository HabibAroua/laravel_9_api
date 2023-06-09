<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [App\Http\Controllers\AuthAuthRegisterController::class, 'register']);
Route::post('login', [App\Http\Controllers\AuthLoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group
(
    function()
    {
        Route::get
        (
            '/profile', function (Request $request)
            {
                return $request->user();
            }
        );
        Route::put('profile', [App\Http\Controllers\ProfileController::class, 'update']);
        //Route::post('email-verification',[EmailVerificationController::class, 'email_verification']);
    }
);