<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Gluii\Presenters\Setup\PresentableTrait;

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
	public function author()
	{
		return $this->belongsTo('App\User', 'user_id');
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