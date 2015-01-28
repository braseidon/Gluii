<?php namespace App;

use App\Gluii\Presenters\Setup\PresentableTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, PresentableTrait;

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
	 * Relationship with Friends
	 *
	 * @return Collection
	 */
	public function friends()
	{
		return $this->belongsToMany('User', 'users_friends', 'user_id', 'friend_id')
			->withPivot('accepted')
			->withTimestamps();
	}

    /*
	|--------------------------------------------------------------------------
	| Data
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Send a Friend Request
	 *
	 * @param User $user
	 */
	public function addFriend(User $user)
	{
		$this->friends()->attach($user->id);
	}

	/**
	 * Remove a Friend Request
	 *
	 * @param  User   $user
	 * @return void
	 */
	public function removeFriend(User $user)
	{
		$this->friends()->detach($user->id);
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
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		User::created(function($user)
		{
			\Event::fire(new App\Events\Users\UserRegistered($user->id));
		});
	}

}
