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

Route::get('place', 'PlaceController@index');
Route::get('place/{id}', 'PlaceController@show');
Route::post('place', 'PlaceController@create');
Route::put('place/{id}', 'PlaceController@update');
Route::delete('place/{id}', 'PlaceController@destroy');