<?php namespace App\Gluii\Support\Traits;

use App\Activity;
use Auth;
use ReflectionClass;

trait PublishesActivity
{

    /**
     * Use ReflectionClass to get the class name
     *
     * @param  Model $model
     * @return string
     */
    protected function getActivityName($model, $action)
    {
        $name = strtolower((new ReflectionClass($model))->getShortName());

        return "{$action}_{$name}";
    }

    /**
     * Model event boot
     *
     * @return void
     */
    protected static function bootPublishActivity()
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
     * @param  string $event
     * @return void
     */
    public function publishActivity($event)
    {
        Activity::create([
            'subject_id'    => $this->id,
            'subject_type'  => get_class($this),
            'name'          => $this->getActivityName($this, $event),
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
}
