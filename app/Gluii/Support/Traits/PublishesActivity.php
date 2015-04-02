<?php namespace App\Gluii\Support\Traits;

use App\Models\Activity;
use Auth;
use ReflectionClass;

trait PublishesActivity
{

    /**
     * Activities belong to a User
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Use ReflectionClass to get the class name
     *
     * @param  Model $model
     * @return string
     */
    public function getActivityNameOne($model)
    {
        return strtolower((new ReflectionClass($model))->getShortName());
    }

    /**
     * Use ReflectionClass to get the class name
     *
     * @param  Model $model
     * @return string
     */
    public function getActivityNameTwo($model)
    {
        return strtolower(class_basename(get_class($model)));
    }

    /**
     * Model event boot
     *
     * @return void
     */
    protected static function bootPublishesActivity()
    {
        foreach (static::getModelEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->publishActivity($event);
            });
        }
    }

    /**
     * Publish activity for the given event
     *
     * @param  string $action
     * @return void
     */
    public function publishActivity($action)
    {
        Activity::create([
            'subject_id'    => $this->id,
            'subject_type'  => get_class($this),
            'action'        => $action,
            'name'          => $this->getActivityName($this),
            'user_id'       => Auth::getUser()->id,
        ]);
    }

    /**
     * Returns the model events we're publishing activity for
     *
     * @return array
     */
    protected static function getModelEvents()
    {
        if (isset(static::$recordEvents)) {
            return static::$recordEvents;
        }

        return ['created']; //, 'updated'
    }

    /**
     * Returns the class without "Activity" on the end
     *
     * @return string
     */
    public function getMorphClass()
    {
        return rtrim(get_class($this), 'Activity');
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
