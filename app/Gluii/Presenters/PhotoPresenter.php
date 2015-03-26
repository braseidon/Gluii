<?php namespace App\Gluii\Presenters;

use Config;
use HTML;

use App\Gluii\Presenters\Setup\Presenter;

class PhotoPresenter extends Presenter
{

    /**
     * Return a Photo's thumbnail that links to the larger size
     *
     * @param  string $thumbSize
     * @param  string $imageSize
     * @return string
     */
    public function thumbLink($thumbSize = 'thumb-md', $attributes = [])
    {
        $link = route('asset/img', ['medium', $this->routePath()]);

        return '<a href="' . $link . '" data-toggle="lightbox">' . $this->image() . '</a>';
    }

    /**
     * Output a Photo
     *
     * @param  string $size
     * @return string
     */
    public function image($size = 'medium', $attributes = ['class' => 'img-responsive'])
    {
        $attributes = HTML::attributes($attributes);

        return '<img src="' . $this->url($size) . '" alt="" />';
    }

    /**
     * Returns the image URL
     *
     * @param  string $size
     * @return string
     */
    public function url($size = 'thumb-sm')
    {
        return '/' . Config::get('photos.dirs.base_url') . '/' . $size . '/' . $this->routePath();
    }

    public function routePath()
    {
        return $this->entity->path . '/' . $this->entity->user_id . '/' . $this->entity->filename;
    }
}
