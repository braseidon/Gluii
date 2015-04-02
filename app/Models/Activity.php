<?php namespace App\Models;

use App\Gluii\Presenters\Setup\PresentableTrait;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    use PresentableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['subject_id', 'subject_type', 'action', 'name', 'user_id'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Get the user responsible for the given activity.
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the subject of the activity.
     *
     * @return mixed
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Return activityType for selecting the model
     *
     * @param  string $value
     * @return string
     */
    public function getactivityTypeAttribute($value)
    {
        if (is_null($value)) {
            return $value;
        }

        return $value . 'Activity';
    }
}
