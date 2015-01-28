<?php

use Poseidon\Social\Statuses\Events\StatusWasPublished;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;

class Status extends \Eloquent {

	use EventGenerator, PresentableTrait;

	/**
	 * Fillable fields for a new status.
	 *
	 * @var array
	 */
	protected $fillable = ['body'];

	/**
	 * Path to the presenter for a status.
	 *
	 * @var string
	 */
	protected $presenter = 'Poseidon\Presenters\Social\StatusPresenter';

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * A status belongs to a user.
	 */
	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/**
	 * @return mixed
	 */
	public function comments()
	{
		return $this->hasMany('Comment', 'status_id');
	}

	/*
	|--------------------------------------------------------------------------
	| Random Shit
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * Publish a new status.
	 *
	 * @param $body
	 * @return static
	 */
	public static function publish($body)
	{
		$status = new static(compact('body'));

		$status->raise(new StatusWasPublished($body));

		return $status;
	}

}