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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/hello', 'HomeController@index2')->name('private');


Route::get('messages', 'MessageController@fetchMessages');
Route::post('messages', 'MessageController@sendMessage');
