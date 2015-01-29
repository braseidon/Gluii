<?php namespace App;

// use Poseidon\Social\Statuses\Events\StatusWasPublished;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;
use Gluii\Presenters\Status;

class Status extends Model {

	use EventGenerator, PresentableTrait;

	/**
	 * Fillable fields for a new status.
	 *
	 * @var array
	 */
	protected $fillable = ['body'];

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
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

		// $status->raise(new StatusWasPublished($body));

		return $status;
	}

}