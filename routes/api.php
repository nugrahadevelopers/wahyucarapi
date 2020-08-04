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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::get('logout', 'Api\AuthController@logout');
Route::post('save-user-info', 'Api\AuthController@SaveUserInfo')->middleware('jwtAuth');

Route::post('mobil/create', 'Api\MobilController@create')->middleware('jwtAuth');
Route::post('mobil/delete', 'Api\MobilController@delete')->middleware('jwtAuth');
Route::post('mobil/update', 'Api\MobilController@update')->middleware('jwtAuth');
Route::get('mobil/showmobil', 'Api\MobilController@showMobil')->middleware('jwtAuth');
Route::get('mobil/showmobilbekas', 'Api\MobilController@showMobilBekas')->middleware('jwtAuth');
Route::get('mobil/mobilku', 'Api\MobilController@mobilKu')->middleware('jwtAuth');
Route::post('mobil/getmobil', 'Api\MobilController@getMobil')->middleware('jwtAuth');
