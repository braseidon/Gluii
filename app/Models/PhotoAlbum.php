<?php namespace App\Models;

use App\Gluii\Support\Traits\PublishesActivity;
use Image;

use Illuminate\Database\Eloquent\Model;

class PhotoAlbum extends Model
{

    use PresentableTrait, PublishesActivity;

    /**
     * The database table used by this model
     *
     * @var string
     */
    protected $table = 'photo_albums';

    /**
     * @var array
     */
    protected $fillable = [];

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
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Relationship with Photo
     *
     * @return Photo
     */
    public function photos()
    {
        return $this->hasMany('App\Models\Photo', 'album_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    |
    |
    */
}
