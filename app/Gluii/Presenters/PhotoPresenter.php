<?php namespace App\Gluii\Presenters;

use Config;

use App\Gluii\Presenters\Setup\Presenter;

class PhotoPresenter extends Presenter {

	/**
	 * Returns the image URL
	 *
	 * @param  string $size
	 * @return string
	 */
	public function url($size = 'thumb-sm')
	{
		return '/' . Config::get('photos.dirs.base_url') . '/' . $size . '/' . $this->entity->path . '/' . $this->entity->user_id . '/' . $this->entity->filename;
	}
}