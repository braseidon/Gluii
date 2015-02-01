<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Gluii\Presenters\Setup\PresentableTrait;
use Gluii\Presenters\StatusPresenter;

class Status extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'statuses';

	/**
	 * Fillable fields for a new status.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'body'];

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
		return $this->belongsTo('App\User', 'user_id');
	}

	/**
	 * @return mixed
	 */
	public function comments()
	{
		return $this->hasMany('App\Comment', 'status_id');
	}

}