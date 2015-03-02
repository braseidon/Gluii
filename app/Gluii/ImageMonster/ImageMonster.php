<?php namespace App\Gluii\ImageMonster;

use Config;
use File;
use Image;

class ImageMonster implements PhotoGuardInterface {

	/**
	 * Process an Image
	 *
	 * @param  string  $imagePath
	 * @param  string  $filePath
	 * @param  string  $filename
	 * @return Image
	 */
	public function process($imagePath, $filePath, $filename)
	{
		// Make image
		$image = $this->make($imagePath);

		// Check the constraints
		$image = $this->checkConstraints($image);

		// Check directory exists, create directory if it doesn't exist
		$this->checkFolderPath($filePath);

		// Save the Image
		return $this->save($image, $filePath, $filename);
	}

	/**
	 * Make an Image from the path
	 *
	 * @param  string $path
	 * @return Image
	 */
	public function make($path)
	{
		return Image::make($path);
	}

	/**
	 * Checks an Image's width and height against the options
	 *
	 * @param  Image  $image
	 * @return Image
	 */
	protected function checkConstraints(\Intervention\Image\Image $image)
	{
		$image = $this->checkDimensions($image);
		$image = $this->checkFilesize($image);

		return $image;
	}

	/**
	 * Check Image dimensions & resize if needed
	 *
	 * @param  Image $image
	 * @return Image
	 */
	public function checkDimensions($image)
	{
		$maxWidth = Config::get('photos.limits.width', 2000);
		$maxHeight = Config::get('photos.limits.height', 2000);

		if($image->height() > $maxHeight || $image->width() > $maxWidth)
		{
			return $this->contain($image, $maxWidth, $maxHeight);
		}

		return $image;
	}

	/**
	 * Check filesize constraints & resize if needed
	 *
	 * @param  Image $image
	 * @return Image
	 */
	public function checkFilesize($image)
	{
		return $image;
	}

	/**
	 * Shrink an image  or expand if needed
	 *
	 * @param  ServerFactory $image
	 * @param  integer|null $maxWidth
	 * @param  integer|null $maxHeight
	 * @return ServerFactory
	 */
	public function contain($image, $maxWidth = null, $maxHeight = null)
	{
		return $image->resize($maxWidth, $maxHeight, function ($constraint) {
			$constraint->aspectRatio();
			$constraint->upsize();
		});
	}

	/**
	 * Checks if the folder path exists. If not, it creates it
	 *
	 * @param  string $path
	 * @return File
	 */
	public function checkFolderPath($path)
	{
		if(! File::isDirectory($path))
		{
			return File::makeDirectory($path, 0775, true);
		}

		return File::isDirectory($path);
	}

	/**
	 * Generate a new path for an image
	 *
	 * @param  string $type
	 * @param  string $userid
	 * @return string
	 */
	public function generatePath($type, $userid)
	{
		return storage_path() . '\\img\\' . $type . '\\' . $userid . '\\';
	}

	/**
	 * Make filename a random string .jpg
	 *
	 * @return string
	 */
	public function generateFilename()
	{
		return str_random() . '.jpg';
	}

	/**
	 * Save the Image to the correct path
	 *
	 * @param  string  $imagePath
	 * @param  string  $path
	 * @param  string  $filename
	 * @return Image
	 */
	public function save($image, $path, $filename)
	{
		return $image->save($path . $filename);
	}
}