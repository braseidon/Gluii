<?php namespace App;

use Image;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

	use PresentableTrait;

	/**
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * The database table used by this model
	 *
	 * @var string
	 */
	protected $table = 'photos';

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Relationship with User
	 *
	 * @return User
	 */
	public function owner()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	/**
	 * Relationship with Photo
	 *
	 * @return Photo
	 */
	public function photos()
	{
		return $this->hasMany('App\Photo', 'album_id');
	}

	/*
	|--------------------------------------------------------------------------
	| Attributes
	|--------------------------------------------------------------------------
	|
	|
	*/

}