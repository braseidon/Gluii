<?php namespace App\Models;

use Auth;
use App\Gluii\Presenters\Setup\PresentableTrait;
use App\Gluii\User\Traits\FriendableTrait;
use App\Gluii\User\Traits\LikeableTrait;
use App\Gluii\User\Traits\UserNotifications;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Events\Dispatcher;

class User extends EloquentUser implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, FriendableTrait, LikeableTrait, UserNotifications, PresentableTrait;

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
    protected $fillable = ['email', 'password', 'first_name','last_name', 'birthday', 'gender'];

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
        return $this->hasMany('App\Models\Status', 'profile_user_id', 'id');
    }

    /**
     * Relationship with Comment
     *
     * @return Collection
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'user_id', 'id');
    }

    /**
     * Relationship with Photo
     *
     * @return Collection
     */
    public function photos()
    {
        return $this->hasMany('App\Models\Photo', 'user_id', 'id');
    }

    /**
     * Relationship with Profile Photo
     *
     * @return Photo
     */
    public function profilepic()
    {
        return $this->belongsTo('App\Models\Photo', 'profile_photo_id');
    }

    /**
     * Relationship with Notification
     *
     * @return Collection
     */
    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'user_id', 'id');
    }

    /**
     * Relationship with Statuses through Subscriptions
     *
     * @return Collection
     */
    public function subscribedstatuses()
    {
        return $this->belongsToMany('App\Models\Status', 'status_subscribers', 'user_id', 'status_id')
            ->withPivot('user_id', 'status_id');
    }

    /**
     * Get the activity timeline for the user.
     *
     * @return mixed
     */
    public function activities()
    {
        return $this->hasMany('App\Models\Activity')
            ->with(['user', 'subject'])
            ->latest();
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
     * @param  Builder  $query
     * @param  integer  $activitiesPerPage
     * @return Builder
     */
    public function scopeLoadProfile($query, $activityTypes = ['status', 'photo'], $activitiesPerPage = 10)
    {
        return $query->with([
                // 'activities' => function ($q) use ($activityTypes, $activitiesPerPage) {
                //     $q->whereIn('subject_type', $activityTypes)
                //         ->limit($activitiesPerPage);
                // },
                // 'activities.likes',
                'friends' => function ($q) {
                    $q->limit(9)
                        ->latest();
                },
                'photos' => function ($q) {
                    $q->limit(12)
                        ->latest();
                },
            ]);
    }

    /**
     * Adds column selects to efficiently grab User data from the database
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeSelectForFeed($query)
    {
        return $query->addSelect('id', 'username', 'first_name', 'last_name', 'email', 'profile_photo');
    }

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * If Username isn't set, use the User's ID instead (for routing)
     *
     * @param  mixed $value
     * @return mixed
     */
    public function getUsernameAttribute($value)
    {
        if ($value == null) {
            return $this->id;
        }

        return $value;
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Returns true if User is the current Authenticated User
     *
     * @return boolean
     */
    public function isMe()
    {
        if (! Auth::check()) {
            return false;
        }

        if (Auth::getUser()->id == $this->id) {
            return true;
        }

        return false;
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
