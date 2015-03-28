<?php namespace App\Gluii\Presenters;

use App\Gluii\Presenters\Setup\Presenter;

class ActivityPresenter extends Presenter
{
    /**
     * Shows the formatted created_at time
     *
     * @return string
     */
    public function timeFormatted()
    {
        return $this->entity->created_at->format('F jS, Y @ g:ia');
    }
}
