<?php namespace App;

use Laracasts\Presenter\PresentableTrait;
use App\Gluii\Presenters\CommentPresenter;

class Comment extends Model {

	use PresentableTrait;

	/**
	 * @var array
	 */
	protected $fillable = ['user_id', 'status_id', 'body'];

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
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