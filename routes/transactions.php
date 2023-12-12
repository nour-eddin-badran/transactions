<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Transaction\TransactionController;
use Illuminate\Support\Facades\Route;


Route::group([
    'namespace' => '\App\Http\Controllers\Api\V1',
    'prefix' => '/v1',
    'middleware' => ['auth:sanctum']
], function () {
    Route::resource('transactions', TransactionController::class)->only('index');
});
