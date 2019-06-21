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


Route::get('/pdf', 'PdfController@index');


Route::get('/export', 'PdfController@export')->name('export.pdf');


Route::get('/getall', 'HomeController@test')->name('test.pdf');


Route::get('hellopdf', function(){
return PDF::loadHTML('Hello World!')->stream('download.pdf');
});



Auth::routes();

//group chat
Route::get('/home', 'HomeController@index')->name('home');

Route::get('messages', 'MessageController@fetchMessages');
Route::post('messages', 'MessageController@sendMessage');

// one to one chat
Route::get('/users', 'HomeController@users')->name('users');
Route::get('/private', 'HomeController@private')->name('private');
Route::get('/private-messages/{user}', 'MessageController@privateMessages')->name('privateMessages');
Route::post('/private-messages/{user}', 'MessageController@sendPrivateMessage')->name('privateMessages.store');