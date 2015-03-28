<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['likable_id', 'likable_type', 'user_id'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Relationship with Likeable
     *
     * @return Model
     */
    public function likable()
    {
        return $this->morphTo();
    }
}
