<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

/*
|--------------------------------------------------------------------------
| Useless Routes
|--------------------------------------------------------------------------
*/

Route::get('quote', 'QuoteController@index');
Route::get('counter', 'CounterController@index');
Route::get('truncate', 'TruncateController@index');
Route::get('decimaltime', 'DecimalTimeController@index');
Route::get('emptystring', 'EmptyStringController@index');
Route::get('pizza', 'PizzaController@index');
Route::get('dogs', 'DogsController@index');

/*
Route::group(['domain' => 'uselessapi.com'], function()
{

    Route::get('quote', 'QuoteController@index');

});
*/
