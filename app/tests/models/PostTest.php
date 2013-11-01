<?php
use Zizaco\FactoryMuff\Facade\FactoryMuff;
class PostTest extends TestCase {

	/**
	 * Test relationship with User
	 */
	public function testRelationshipWithUser()
	{
	  // Instantiate new Post
	  $post = FactoryMuff::create('Post');
	  
	  $this->assertEquals($post->user_id, $post->user->id);
	}

	/**
	 * Test that user_id is required
	 */
	public function testUserIdIsRequired()
	{
	  // Create new Post
	  $post = new Post;
	 
	  // Set the boy
	  $post->body = "Yada yada yada";
	  print_r($post->save());
	  // Post should not save
	  $this->assertFalse($post->save());
	 
	  // Save the errors
	  $errors = $post->errors()->all();

	  // There should be 1 error
	  $this->assertCount(1, $errors);
	 
	  // The error should be set
	  $this->assertEquals($errors[0], "The user id field is required.");
	}


}