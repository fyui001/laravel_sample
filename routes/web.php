<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('post_code')->group(function() {
   Route::get('/', 'PostCodeController@index');
   Route::post('/search', 'PostCodeController@show');
});

/*
 RESTfulなurlにしたいときはこんな感じにする
 Route::prefix('post_code')->group(function() {
     Route::get('/search/{post_code}', 'PostCodeController@show');
 )}
 */
