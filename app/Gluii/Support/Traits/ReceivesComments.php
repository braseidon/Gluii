<?php namespace App\Gluii\Support\Traits;

trait ReceivesComments
{

    /**
     * Relationship to User by Comments
     *
     * @return Collection
     */
    public function comments()
    {
        return $this->morphMany('\App\Models\Comment', 'commentable');
    }

    // Idk
    // public function commentscount()
    // {
    //  return $this->with(['comments' => function($q)
    //  {
    //      $q->select( [\DB::raw("count(*) as like_count"), "user_id"] )
    //          ->groupBy("user_id");
    //  }]);
    // }

    public function addComment(User $user)
    {
        //
    }

    /**
     * Use ReflectionClass to get the class name
     *
     * @param  Model $model
     * @return string
     */
    protected function getModelName($model)
    {
        return strtolower((new ReflectionClass($model))->getShortName());
    }
}
