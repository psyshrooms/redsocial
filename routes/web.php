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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function() {	
	//Api RestFULL para Feeds
	Route::apiResource('feeds','FeedController');

	//imbox para user logeado
	Route::apiResource('imboxs', 'ImboxController');

	# List of Users
	//imbox para user logeado
	Route::apiResource('users', 'UserController');

	//actualizar perfil para user logeado
	Route::post('user/profile', 'ProfileController@update');

	//Obtener Perfil para user logeado o otro {user}
	Route::get('user/{id?}', 'ProfileController@show');

	//Obtener Feeds de otros users
	Route::get('user/{user}/feeds', 'FeedController@showUserFeeds');

	//Solicitud de Amistad a usuario {id} 
	Route::get('user/{id}/friend', 'FriendshipController@addFriend');

	//Retorna Amigos del user logeado
	Route::get('friends' , 'FriendshipController@showFriends');

	//Delete Friends
	Route::delete('friends/{id}' , 'FriendshipController@destroy');
	
});