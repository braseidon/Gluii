<?php namespace App\Models;

use App\Gluii\Comment\Traits\CommentLikeableTrait;
use App\Gluii\Presenters\Setup\PresentableTrait;
use App\Gluii\Support\Traits\PublishesActivity;
use App\Gluii\Support\Traits\ReceivesLikes;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    use PresentableTrait, PublishesActivity, ReceivesLikes;

    /**
     * The database table used by this model
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'status_id', 'body'];

    // protected $with = ['author'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Relationship to Status
     *
     * @return Status
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    /**
     * Relationship to User
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Random Shit
    |--------------------------------------------------------------------------
    |
    |
    */
}
