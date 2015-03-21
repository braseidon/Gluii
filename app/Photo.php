<?php namespace App;

use App\Gluii\Presenters\Setup\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    use PresentableTrait, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'album_id', 'path', 'filename', 'filesize'];

    /**
     * The database table used by this model
     *
     * @var string
     */
    protected $table = 'photos';

    /**
     * Indicates if the model should soft delete.
     *
     * @var bool
     */
    protected $dates = ['deleted_at'];

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
     * Relationship with PhotoAlbum
     *
     * @return PhotoAlbum
     */
    public function album()
    {
        return $this->belongsTo('App\PhotoAlbum', 'album_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    |
    |
    */
}
