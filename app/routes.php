<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{	

	return View::make('hello');
});

Route::get('/user', function()
{
  // Create a new Post
	$post = new Post(array('body' => 'Yada yada yada'));
	// Grab User 1
	$user = User::find(1);
	// Save the Post
	
  var_dump($user->posts()->save($post));
});

Route::get('/phpinfo',function(){
	phpinfo();
});