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

use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('avatar', ['as'=>'avatar', 'uses'=>'AvatarController@index' ]);
    Route::post('resize',['as'=>'resize','uses'=>'AvatarController@resize']);
    Route::post('save',['as'=>'save','uses'=>'AvatarController@save']);
});




