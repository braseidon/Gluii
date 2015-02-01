<?php namespace App\Gluii\Presenters;

use App\Gluii\Presenters\Setup\Presenter;

class StatusPresenter extends Presenter {

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
		return $this->entity->created_at->format('g:ia F jS, Y');
	}

	public function replyCount()
	{
		return number_format($this->entity->comments->count());
	}

}