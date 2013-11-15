<?php 

//cambiar este codigo por el que tiene /var/www/cribbb/vendor/laravelbook/ardent/src/LaravelBook/Ardent/Ardent.php

public function belongsTo($related, $foreignKey = null, $otherKey = null, $relation = null)
    {
		$backtrace = debug_backtrace(false);
		$caller = ($backtrace[1]['function'] == 'handleRelationalArray')? $backtrace[3] : $backtrace[1];

		// If no foreign key was supplied, we can use a backtrace to guess the proper
		// foreign key name by using the name of the relationship function, which
		// when combined with an "_id" should conventionally match the columns.
		$relation = $caller['function'];

		if (is_null($foreignKey)) {
			$foreignKey = snake_case($relation).'_id';
		}

		// Once we have the foreign key names, we'll just create a new Eloquent query
		// for the related models and returns the relationship instance which will
		// actually be responsible for retrieving and hydrating every relations.
		$instance = new $related;
        
        $query = $instance->newQuery();
		$otherKey = $otherKey ?: $instance->getKeyName();

        return new BelongsTo($query, $this, $foreignKey, $otherKey, $relation);
	}


