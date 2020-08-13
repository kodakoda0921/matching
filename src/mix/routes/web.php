<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/index', 'HomeController@index')->name('index');
Route::get('/top', 'HomeController@top')->name('top');
Route::get('/userProfile','UserProfileViewController@UserProfile')->name('userProfile');
Route::post('/userProfile', 'UserProfileViewController@profileUpdate');
Route::get('/chat', 'HomeController@chat');


