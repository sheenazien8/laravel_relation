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

use App\User;
use App\Profile;


Route::get('/create_user', function() {
    $user = User::create([
			'name' => 'Iftah',
			'email' => 'iftah@gmail.com',
			'password' => bcrypt('password')
		]);

		return $user;
});

Route::get('/create_profile', function() {
    $profile = Profile::create([
			'user_id' => 1,
			'phone' => '089638706830',
			'address' => 'JL. Baru no.8'
		]);

		return $profile;
});


Route::get('/create_user_profile', function() {
	// mengakses table user dengan id 2
	$user = User::find(2);

	// insert table profile dengan membawa user id 2
	$profile = new Profile([
		'phone' => '0898673642',
		'address' => 'Jl. Lama dan lama sekali',
	]);

	$user->profile()->save($profile);
	return $user;
});