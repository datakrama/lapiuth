<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('API')->name('api.')->group(function () {
    // Auth
    Route::namespace('Auth')->prefix('auth')->name('auth.')->group(function () {
        Route::post('login', 'LoginController@login');
        Route::post('register', 'RegisterController@register');

        Route::prefix('password')->group(function () {
            Route::post('email', 'ForgotPasswordController@@sendResetLinkEmail');
            Route::post('reset', 'ResetPasswordController@reset');
        });

        Route::middleware('auth:api')->group(function () {
            Route::prefix('email')->name('verification.')->group(function () {
                Route::get('verify/{id}/{hash}', 'VerificationController@verify')->name('verify');
                Route::post('resend', 'VerificationController@resend')->name('resend');
            });

            Route::get('user', 'LoginController@user');
            Route::get('logout', 'LoginController@logout');
        });
    });
});