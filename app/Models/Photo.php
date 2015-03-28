<?php namespace App\Models;

use App\Gluii\Support\Traits\PublishesActivity;
use App\Gluii\Support\Traits\ReceivesComments;
use App\Gluii\Support\Traits\ReceivesLikes;
use App\Gluii\Presenters\Setup\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    use PresentableTrait, PublishesActivity, ReceivesComments, ReceivesLikes, SoftDeletes;

    /**
     * The database table used by this model
     *
     * @var string
     */
    protected $table = 'photos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'album_id', 'path', 'filename', 'filesize'];

    /**
     * Indicates if the model should soft delete.
     *
     * @var bool
     */
    protected $dates = ['deleted_at'];

    /**
     * Helper column used for likes/comments
     *
     * @var string
     */
    public $shortName = 'photo';

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    |
    */

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
    | Query Scopes
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Loads all relationships for displaying the status
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeLoadActivityRelationships($query)
    {
        return $query->with([
                'profileuser' => function ($q) {
                    $q->selectForFeed();
                },
                'user' => function ($q) {
                    $q->selectForFeed();
                },
                'likes' => function ($q) {
                    $q->addSelect('users.id', 'first_name', 'last_name')
                        ->withPivot('user_id');
                },
                'comments' => function ($q) {
                    $q->orderBy('id', 'ASC');
                },
                'comments.user' => function ($q) {
                    $q->selectForFeed();
                },
                'comments.likes' => function ($q) {
                    $q->addSelect('users.id', 'first_name', 'last_name')
                        ->withPivot('user_id');
                },
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    |
    |
    */
}
