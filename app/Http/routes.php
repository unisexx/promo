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

// Route::get('/', function () {
    // return view('welcome');
// });

Route::controller('sticker', 'StickerController');
Route::controller('theme', 'ThemeController');

Route::auth();

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('search', 'HomeController@search');

// เช็กล็อกอิน
Route::group(['middleware' => 'auth'], function () {

    // Creator
    Route::group(['prefix' => 'creator', 'namespace' => 'Creator'], function(){
        Route::controller('dashboard', 'DashboardController');
        Route::controller('sticker', 'StickerController');
        Route::controller('theme', 'ThemeController');
        Route::controller('page', 'PageController');
    });

}); //middleware

Route::get('/test', function() {
    $crawler = Goutte::request('GET', 'https://duckduckgo.com/html/?q=Laravel');
    $crawler->filter('.result__title .result__a')->each(function ($node) {
        dump($node->text());
    });
    return view('welcome');
});