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
use App\Post;
use App\Category;

Route::get('/create_user', function() {
    $user = User::create([
			'name' => 'Iftah',
			'email' => 'iftah@gmail.com',
			'password' => bcrypt('password')
		]);

		return $user;
});

Route::get('/create_profile', function() {
  //   $profile = Profile::create([
		// 	'user_id' => 1,
		// 	'phone' => '089638706830',
		// 	'address' => 'JL. Baru no.8'
		// ]);

		$user = User::find(1);

		$user->profile()->create([
			'phone' => '476474',
			'address' => 'jalanjalanmu'
		]);

		return $user;
});




Route::get('/create_user_profile', function() {
	// mengakses table user dengan id 2
	$user = User::find(2);

	// insert table profile dengan membawa user id 2 menggunakan instance objek
	$profile = new Profile([
		'phone' => '0898673642',
		'address' => 'Jl. Lama dan lama sekali',
	]);

	$user->profile()->save($profile);
	return $user;
});



Route::get('/read_user', function() {
	// mengakses table user dengan id 1
	$user = User::find(2);

	// mengakses field addres di dalam table profile
	// return $user->profile->address;

	// mengakses field di dalam table profile
	$data =[
		'name' => $user->name,
		'email' => $user->email,
		'phone' => $user->profile->phone,
		'address' => $user->profile->address,
	];

	return $data;
});


Route::get('/read_profile', function() {
	// mengakses profile berdasarkan column phone
	$profile = Profile::where('address','jalanjalanmu')->first();

	// mengakses kebalikannya
	$data = [
		'email' => $profile->user->email,
		'name' => $profile->user->name,
		'phone' => $profile->phone,
		'address' => $profile->address,
	];
	return $data;
});

// mengupdate data profile berdasarkan user id
Route::get('/update_profile', function() {
    $user = User::find(2);

    $data = [
		'phone' => '07364276',
		'address' => 'jlan jalan',
		];

    $user->profile()->update($data);

		return $user;
});

// delete data berdasarkan user id
Route::get('/delete_profile', function() {
   $user = User::find(1);

   $user->profile()->delete();

   return $user;
});


Route::get('/create_post', function() {

	// $user = User::create([
	// 	'name' => 'Sheena',
	// 	'email' => 'sheenazien@gmial.com',
	// 	'password' => bcrypt('8slamp'),
	// ]);

	$user = User::findOrFail(2);
	$user->posts()->create([
		'title' => 'Post Baru Member 1',
		'body' => 'Content Member 1.'
	]);

	return 'success';
});

// read data hasmany
Route::get('/read_post', function() {
	$user = User::find(1);

	$posts = $user->posts()->get();

	foreach ($posts as $post) {
		$data[] =[
			'name' => $post->user->name,
			'post_id' => $post->id,
			'title' => $post->title,
			'body' => $post->body
	];
	}
});

Route::get('/update_post', function() {
    $user = User::findOrFail(1);

    $user->posts()->where('id', 2)->update([
			'title' => 'post update id 2',
			'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
		]);

		return 'success';
});


Route::get('/delete_post', function() {
   $user = User::find(1);

   $user->posts()->whereId(2)->delete();

   return 'success';
});

Route::get('/create_categories', function() {
  //   $post = Post::findOrFail(1);

  //   $post->categories()->create([
		// 	'slug' => str_slug('Belajar PHP', '-'),
		// 	'category' => 'Belajar PHP',
		// ]);

		// return 'success';

	$user = User::create([
		'name' => 'Roki',
		'email' => 'roki@gmail.com',
		'password' => bcrypt('8slamp')
	]);

	$user->posts()->create([
		'title' => 'new title for robi',
		'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
	])->categories()->create([
		'slug' => str_slug('New Category', '-'),
		'category' => 'New Category'
	]);

	return 'success';

});


Route::get('/read_category', function() {
	// mencari data melalui model post
    $post = Post::find(2);

    $categories = $post->categories;
    foreach ($categories as $category) {
    	echo $category->slug."</br>";
    }

// mencari data melalui model category
	// $category = Category::find(3);

	// $posts = $category->posts;

	// foreach ($posts as $post) {
	// 	echo $post->title. "</br>";
	// }

});


Route::get('/attach', function() {
    $post = Post::find(1);
    // attach memnentukan category mana yang akan digunakan oleh post tersebut

    // menambah di categori_post
    $post->categories()->attach([1,2,3]);
    // menginputkan 1,2,3 id data categori untuk post id dengan nilai 3
    return 'success';
});


Route::get('/detach', function() {
  //menghapus data yang berelasi ketika ingin menghapus ketgori
	$post = Post::find(5);
	$post->categories()->detach(4);

	return 'success';
});

Route::get('/sync', function (){
	$post = Post::find(1);
	// menyisakan post id 1 dengan categori id 1
	$post->categories()->sync([1]);

	return 'success';
});
