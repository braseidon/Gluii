<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * Fillable fields for a new status.
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

    public function getSubjectTypeAttribute($value)
    {
        if (is_null($value)) {
            return $value;
        }

        return $value . 'Activity';
    }
}
