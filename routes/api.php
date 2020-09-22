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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    Route::post('register', 'Api\UserController@register');
    Route::post('login', 'Api\UserController@login');
    Route::post('logout', 'Api\UserController@logout');
    // Route::post('refresh', 'JWTAuthController@refresh');

});

$router->group(
    ['middleware' => 'jwt.verify'],
    function () use ($router) {

        Route::get('place', 'Api\PlaceController@index');
        Route::get('place/{id}', 'Api\PlaceController@show');
        Route::post('place', 'Api\PlaceController@create');
        Route::put('place/{id}', 'Api\PlaceController@update');
        Route::delete('place/{id}', 'Api\PlaceController@destroy');
        
        Route::get('balance/{id}', 'Api\BalanceController@show');
        Route::put('balance/{id}', 'Api\BalanceController@update');
        
        Route::post('transaction', 'Api\TransactionController@create');
    });
    