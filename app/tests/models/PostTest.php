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

	  //create a user
	  $clique = FactoryMuff::create('Clique');
	 
	  // Post should not save
	  $this->assertFalse($clique->posts()->save($post));
	 
	  // Save the errors
	  $errors = $post->errors()->all();
	 
	  // There should be 1 error
	  $this->assertCount(1, $errors);
	 
	  // The error should be set
	  $this->assertEquals($errors[0], "The user id field is required.");
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

	  //create a user
	  $clique = FactoryMuff::create('Clique');

	  $clique->posts()->save($post);

	  // Post should not save
	  $this->assertFalse($user->posts()->save($post));
	 
	  // Save the errors
	  $errors = $post->errors()->all();

	  // There should be 1 error
	  $this->assertCount(1, $errors);
	 
	  // The error should be set
	  $this->assertEquals($errors[0], "The body field is required.");
	}

	public function testPostCliqueIsRequered()
	{
		//create new Post
		$post = new Post;

		// set the body
		$post->body = "lalala cuerpo";

		//create a user 
		$user = FactoryMuff::create('User');

		// Post should not save
	  	$this->assertFalse($user->posts()->save($post));

	  	//save the erros
	  	$errors = $post->errors()->all();

	  	//there should be 1 error
	  	$this->assertCount(1, $errors);

	  	//the error should be set
	  	$this->assertEquals($errors[0], "The clique id field is required.");

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