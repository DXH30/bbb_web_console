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

Route::get('/', 'PageController@landing');
Route::get('login' , 'PageController@login')->name('page_login');
Route::get('register', 'PageController@register')->name('page_register');

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::get('logout', 'UserController@logout')->name('logout');

Route::prefix('meeting')->group(function() {
    Route::get('/', 'PageController@meeting')->name('page_meeting');
    Route::post('/', 'MeetingController@post_meeting');
    Route::get('join/{id}', 'MeetingController@join');
    Route::post('join/{id}', 'MeetingController@join');
    Route::get('delete', 'MeetingController@delete');
});

Route::get('mpj', 'PageController@meeting_public');
Route::post('mpj', 'MeetingController@join');

Route::prefix('user')->group(function() {
    Route::get('/', 'PageController@user')->name('page_user');
    Route::get('edit/{id}', 'PageController@user_edit');
    Route::post('edit/{id}', 'UserController@user_edit');
    Route::get('verifikasi', 'UserController@verifikasi');
    Route::get('unverifikasi', 'UserController@unverifikasi');
    Route::get('to_m', 'UserController@to_moderator');
    Route::get('to_a', 'UserController@to_attendee');
    Route::get('delete', 'UserController@delete');
});

Route::prefix('dashboard')->group(function() {
    Route::get('/', 'PageController@dashboard')->name('page_dashboard');
});

