<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeCounter extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'like_counters';


    /**
     * Don't use timestamps
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['likable_id', 'likable_type', 'count'];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    |
    */

   /**
    * Relationship with Likes
    *
    * @return Like
    */
    public function likable()
    {
        return $this->morphTo();
    }
}
