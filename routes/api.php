<?php

use App\User;
use Illuminate\Http\Request;

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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'ApiTokenController@login');    //Login
Route::get('/logout',  'ApiTokenController@logout')->middleware(['auth:api']);    //logout
Route::post('/registration',  'ApiTokenController@registration');  //Registration

// Route::get('/wallet-balance',  'ApiTokenController@walletBalance')->middleware(['auth:api']);    //walletBalance
Route::get('/wallet-balance',  'ApiTokenController@walletBalance');    //walletBalance
