<?php namespace App\Gluii\Presenters;

use App\Gluii\Presenters\Setup\Presenter;

class StatusPresenter extends Presenter
{

    /**
     * Display how long it has been since the publish date.
     *
     * @return mixed
     */
    public function timeSincePublished()
    {
        return $this->entity->created_at->diffForHumans();
    }

    /**
     * Shows the formatted created_at time
     *
     * @return string
     */
    public function timeFormatted()
    {
        return $this->entity->created_at->format('F jS, Y @ g:ia');
    }

    /**
     * Count the replies to a Status
     *
     * @return int
     */
    public function replyCount()
    {
        if (! $this->entity->comments->isEmpty()) {
            return number_format($this->entity->comments->count());
        }

        return 0;
    }
}
