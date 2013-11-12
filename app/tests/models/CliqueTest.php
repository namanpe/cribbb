<?php
use Zizaco\FactoryMuff\Facade\FactoryMuff;
class CliqueTest extends TestCase {

public function testNameIsRequired()
{
	//create a new clique
	$clique = new Clique;

	//This should  not save
	$this->assertFalse($clique->save());

	//save the errors
	$errors = $clique->errors()->all();

	//there should be 1 error
	$this->assertCount(1,$errors);

	//the error should be set
	$this->assertEquals($errors[0],"The name field is required.");
}

public function testCliqueUserRelationship()
{
	// create a new clique
	$clique = FactoryMuff::create('Clique');

	// create two news users
	$user1 = FactoryMuff::create('User');
	$user2 = FactoryMuff::create('User');

	//save Users to Clique
	$clique->users()->save($user1);
	$clique->users()->save($user2);

	//count number of Users
	$this->assertCount(2,$clique->users);
}




}