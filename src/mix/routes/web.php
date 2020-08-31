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
Route::get('/profile/{id}','UserProfileViewController@profileView');

// 勉強会関連
Route::get('/meeting', 'HomeController@meeting')->name('meeting');
Route::get('/meeting_regist', 'MeetingViewController@meetingRegistView')->name('meeting.regist');
Route::post('/meeting_regist', 'MeetingViewController@meetingRegist')->name('meeting.regist');
Route::get('/meeting/view/{id}','MeetingViewController@meetingView')->name('meeting.view');
Route::get('/meeting/edit/{id}','MeetingViewController@meetingEditView')->name('meeting.edit');
Route::post('/meeting/edit/{id}','MeetingViewController@meetingEdit')->name('meeting.edit');
Route::get('/meeting/delete/{id}','MeetingViewController@meetingDelete')->name('meeting.delete');
Route::get('/meeting/approval/{id}', 'MeetingViewController@meetingApproval');
Route::get('/meeting/unapproval/{id}', 'MeetingViewController@meetingUnapproval');
Route::get('/meeting/chat/{id}', 'HomeController@meetingChatView');
Route::get('/meeting/chat/get/{id}', 'HomeController@meetingChatGet');
Route::put('/meeting/chat/put/{id}', 'HomeController@meetingChatPut');

// 勉強会検索
Route::get('meetingSerch', 'MeetingViewController@search');
Route::get('meeting/search/{id}', 'MeetingViewController@searchView');
Route::put('/meeting/join/{id}', 'MeetingViewController@meetJoinRequest');



