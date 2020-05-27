<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;

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
Route::post('transaction', 'CreditCardController@transaction');
Route::post('subscription', 'CreditCardController@subscription');

//user routes
Route::get('users', 'UserController@index');
Route::get('user/{id}', 'UserController@show');
Route::post('user', 'UserController@store');
Route::put('user/{id}', 'UserController@update');
Route::delete('user/{id}', 'UserController@destroy');

//Credit Card Routes 
// Route::post('card','CreditCardController@createCard');
// Route::post('creditCard', 'CreditCardController@store');
// Route::put('creditCard/{id}', 'CreditCardController@update');
// Route::delete('creditCard/{id}', 'CreditCardCintroller@destroy');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
