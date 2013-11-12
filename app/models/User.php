<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends Ardent implements UserInterface, RemindableInterface {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Ardent validation rules
	 */
	public static $rules = array(
	  'username' => 'required|between:4,16',
	  'email' => 'required|email',
	  'password' => 'required|alpha_num|min:8|confirmed',
	  'password_confirmation' => 'required|alpha_num|min:8',
	);

	/**
	 * Factory
	 */
	public static $factory = array(
	  'username' => 'string',
	  'email' => 'email',
	  'password' => 'password',
	  'password_confirmation' => 'password'
	);

	/**
	*Automatically purge redundant data for confirmation
	*/
	public $autoPurgeRedundantAttributes = true;

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Post relationship
	 */
	public function posts()
	{
	  return $this->hasMany('Post');
	}

	/**
	*User following relationship
	*/
	public function follow(){
		return $this->belongsToMany('User', 'user_follows', 'user_id', 'follow_id')->withTimestamps();
	}

	/**
	 * User followers relationship
	 */
	public function followers()
	{
	  return $this->belongsToMany('User', 'user_follows', 'follow_id', 'user_id')->withTimestamps();
	}

	/**
	 * Clique relationship
	 */
	public function clique(){
	  return $this->belongsToMany('Clique');
	}

}