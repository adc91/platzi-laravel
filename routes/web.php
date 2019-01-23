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

Auth::routes();

Route::get('/', 'PagesController@home');
Route::get('/messages/{message}', 'MessagesController@show');

// Registar & Login
Route::get('/auth/facebook', 'SocialAuthController@facebook');
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');
Route::post('/auth/facebook/register', 'SocialAuthController@register');

Route::get('/home', 'HomeController@index')->name('home');

// Users
Route::get('/{username}', 'UsersController@show');
Route::get('/{username}/follows', 'UsersController@follows');
Route::get('/{username}/followers', 'UsersController@followers');

// Routas con autenticación requerida
Route::group(['middleware' => 'auth'], function () {
     // Conversations
    Route::get('/conversations/{conversation}', 'UsersController@showConversation');

    // Messages
    Route::post('/messages/create', 'MessagesController@create');

    // Users
    Route::post('/{username}/dms', 'UsersController@sendPrivateMessage');
    Route::post('/{username}/follow', 'UsersController@follow');
    Route::post('/{username}/unfollow', 'UsersController@unfollow');
});
