<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;

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


Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'auth'], function () {
//        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });

//    Route::group(['prefix' => 'verification'], function () {
//        Route::post('verify', [VerificationController::class, 'verify']);
//        Route::post('send', [VerificationController::class, 'send']);
//    });
//
//    Route::group(['prefix' => 'password'], function () {
//        Route::post('reset', [PasswordController::class, 'reset']);
//    });

});
