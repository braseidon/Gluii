<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Gluii\Presenters\Setup\PresentableTrait;
use App\Gluii\User\Traits\FriendableTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Events\Dispatcher;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, FriendableTrait, PresentableTrait;

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
		return $this->hasMany('App\Status', 'profile_user_id');
	}

	/*
	|--------------------------------------------------------------------------
	| Query Scopes
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Load relationships when viewing a User's profile
	 *
	 * @param  Builder $query
	 * @return Builder
	 */
	public function scopeViewProfile($query)
	{
		return $query->with([
				'statuses' => function($q)
				{
					$q->orderBy('id', 'DESC');
				},
				'statuses.profileuser',
				'statuses.author',
				'statuses.comments',
				'statuses.comments.author',
			]);
	}

	/*
	|--------------------------------------------------------------------------
	| Repository
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Get a User's pending received friend requets
	 *
	 * @return Collection
	 */
	public function requestsPending()
	{
		return static::friendsfrom()
			->where('users_friends.accepted', '=', 0)
			// ->select('users.id', 'users_friends.id', 'users_friends.user_id', 'users_friends.friend_id', 'users_friends.accepted')
			->get();
	}

	/**
	 * Get a User's pending sent friend requets
	 *
	 * @return Collection
	 */
	public function requestsSent()
	{
		return static::friends()
			->where('users_friends.accepted', '=', 0)
			->get();
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
