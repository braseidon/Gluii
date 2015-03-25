<?php namespace App\Models;

use App\Gluii\Support\Traits\PublishesActivity;
use App\Gluii\Presenters\Setup\PresentableTrait;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    use PresentableTrait, PublishesActivity, SoftDeletes;

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
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Relationship with PhotoAlbum
     *
     * @return PhotoAlbum
     */
    public function album()
    {
        return $this->belongsTo('App\Models\PhotoAlbum', 'album_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    |
    |
    */
}
