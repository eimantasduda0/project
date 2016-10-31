<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', ['as'=>'index','uses'=>'HomeController@index']);

Route::match(['get','post'],'/settings', ['as'=>'settings','uses'=>'HomeController@settings']);
Route::match(['get','post'],'/info/{id}', ['as'=>'itemInfo','uses'=>'ItemController@itemInfo']);
Route::match(['get','post'],'/items', ['as'=>'itemInfo','uses'=>'ItemController@items']);
Route::match(['get','post'],'/item/{id}',['as'=>'itemSettings','uses'=>'ItemController@itemSettings']);