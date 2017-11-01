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

Route::get('/home', 'HomeController@index');

// เช็กล็อกอิน
Route::group(['middleware' => 'auth'], function () {

    // Creator
    Route::group(['prefix' => 'creator', 'namespace' => 'creator'], function(){
        Route::controller('dashboard', 'DashboardController');
        Route::controller('sticker', 'StickerController');
    });

}); //middleware