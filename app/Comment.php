<?php

use Laracasts\Presenter\PresentableTrait;

class Comment extends \Eloquent {

	use PresentableTrait;

	/**
	 * @var array
	 */
	protected $fillable = ['user_id', 'status_id', 'body'];

	/**
	 * Path to the presenter for a status.
	 *
	 * @var string
	 */
	protected $presenter = 'Poseidon\Presenters\Social\CommentPresenter';

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	/**
	 * @return mixed
	 */
	public function owner()
	{
		return $this->belongsTo('User', 'user_id');
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
	 * @param $body
	 * @param $statusId
	 * @return static
	 */
	public static function leave($body, $statusId)
	{
		return new static([
			'body' => $body,
			'status_id' => $statusId
		]);
	}

}