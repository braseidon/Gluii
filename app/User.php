<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gluii\Presenters\Setup\PresentableTrait;
use App\Gluii\User\Traits\FriendableTrait;
use App\Gluii\User\Traits\LikeableTrait;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Events\Dispatcher;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, FriendableTrait, LikeableTrait, PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name','last_name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Relationship with Status
	 *
	 * @return Collection
	 */
	public function statuses()
	{
		return $this->hasMany('App\Status', 'profile_user_id', 'id');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment', 'user_id', 'id');
	}

	/**
	 * Relationship with Photo
	 *
	 * @return Collection
	 */
	public function photos()
	{
		return $this->hasMany('App\Photo', 'user_id', 'id');
	}

	/**
	 * Relationship with Notification
	 *
	 * @return Collection
	 */
	public function notifications()
	{
		return $this->hasMany('App\Notification', 'user_id', 'id');
	}

	/*
	|--------------------------------------------------------------------------
	| Query Scopes
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Load a User's Profile
	 *
	 * @param  Builder $query
	 * @return Builder
	 */
	public function scopeLoadProfile($query)
	{
		// return $query->with([
		// 		'statuses' => function($q)
		// 		{
		// 			$q->orderBy('id', 'DESC');
		// 		},
		// 		'statuses.profileuser',
		// 		'statuses.author',
		// 		'friends',
		// 	]);
	}

	/*
	|--------------------------------------------------------------------------
	| Model Events
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public static function boot()
	{
		parent::boot();

		// parent::created(function($user)
		// {
		// 	//
		// });
	}

}
