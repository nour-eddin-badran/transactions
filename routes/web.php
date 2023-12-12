<?php

use App\Http\Controllers\Admin\Transaction\TransactionController;
use App\Http\Controllers\Admin\Transaction\TransactionPaymentController;
use App\Http\Controllers\Admin\Report\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', 'HomeController@index');

    Route::group(['namespace' => 'Admin'], function () {
        Route::resource('users', UserController::class);

        Route::resource('transactions', TransactionController::class)->name('index', 'admin.transactions.index');
        Route::resource('transactions/{transaction}/payments', TransactionPaymentController::class)->name('index', 'admin.payments.index');
        Route::post('reports', [ReportController::class, 'generate'])->name('reports.generate');
    });

    Route::group(['namespace' => 'Admin\Ajax', 'prefix' => 'ajax'], function () {


    });
});



Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Auth'], function () {

    Route::get('login', function () {
        return view('auth.login');
    })->name('login');
    Route::get('register', function () {
        return view('auth.register');
    })->name('register');
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
