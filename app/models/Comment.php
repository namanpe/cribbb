<?php 

use LaravelBook\Ardent\Ardent;

class Comment extends Ardent {


	/**
	 * Properties that can be mass assigned
	 *
	 * @var array
	 */
	protected $fillable = array('body');
	
	public function commentable()
	{
		return $this->morphTo();
	}
}


