<?php

use LaravelBook\Ardent\Ardent;

class Post extends Ardent {

	protected $fillable = array('body');
  	
  	/**
	 * Ardent validation rules
	 */
	public static $rules = array(
	  'body' => 'required',
	  'user_id' => 'required|numeric',
	  'clique_id' => 'required|numeric'
	);

	/**
	 * Factory
	 */
	public static $factory = array(
	  'body' => 'text',
	  'user_id' => 'factory|User',
	  'clique_id' => 'factory|Clique'
	);


  	/**
	* User relationship
	*/
	public function user()
	{
	return $this->belongsTo('User');
	}

	/**
	 * Clique relationship
	 */
	public function clique()
	{
	  return $this->belongsTo('Clique');
	}

	/**
	 * Comment relationship
	 */
	public function comments()
	{
	  return $this->morphMany('Comment', 'commentable');
	}
}