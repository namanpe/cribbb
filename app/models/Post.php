<?php

use LaravelBook\Ardent\Ardent;

class Post extends Ardent {

	protected $fillable = array('body');
  	
  	/**
	 * Ardent validation rules
	 */
	public static $rules = array(
	  'body' => 'required',
	  'user_id' => 'required|numeric'
	);

	/**
	 * Factory
	 */
	public static $factory = array(
	  'body' => 'text',
	  'user_id' => 'factory|User',
	);


  	/**
	* User relationship
	*/
	public function user()
	{
	return $this->belongsTo('User');
	}

	/**
	 * Test that Posts' body is required
	 */
	public function testPostBodyIsRequired()
	{
	  // Create new Post
	  $post = new Post;
	 
	  // Create a User
	  $user = FactoryMuff::create('User');
	 
	  // Post should not save
	  $this->assertFalse($user->posts()->save($post));
	 
	  // Save the errors
	  $errors = $post->errors()->all();
	 
	  // There should be 1 error
	  $this->assertCount(1, $errors);
	 
	  // The error should be set
	  $this->assertEquals($errors[0], "The body field is required.");
	}
   
   /**
	 * Test Post saves correctly
	 */
	public function testPostSavesCorrectly()
	{
	  // Create a new Post
	  $post = FactoryMuff::create('Post');
	 
	  // Save the Post
	  $this->assertTrue($post->save());
	}
}