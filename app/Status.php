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
	protected $fillable = ['profile_user_id', 'author_id', 'body'];

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * A status belongs to a User
	 */
	public function profileuser()
	{
		return $this->belongsTo('App\User', 'profile_user_id');
	}

	/**
	 * A status writer belongs to a User
	 */
	public function author()
	{
		return $this->belongsTo('App\User', 'author_id');
	}

	/**
	 * @return mixed
	 */
	public function comments()
	{
		return $this->hasMany('App\Comment', 'status_id');
	}

}