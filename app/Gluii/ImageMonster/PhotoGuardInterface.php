<?php namespace App\Gluii\ImageMonster;

interface PhotoGuardInterface
{

    /**
     * Process a new Image
     *
     * @param  string  $imagePath
     * @param  string  $filePath
     * @param  string  $filename
     * @return Image
     */
    public function process($imagePath, $filePath, $filename);

    /**
     * Make an Image from the path
     *
     * @param  string $path
     * @return Image
     */
    public function make($path);

    /**
     * Save the Image to the correct path
     *
     * @param  Image   $image
     * @param  string  $path
     * @param  string  $filename
     * @return Image
     */
    public function save($image, $path, $filename);

    /**
     * Check the dimensions of an image
     *
     * @param  Image $image
     * @return bool
     */
    public function checkDimensions($image);

    /**
     * Check the filesize
     *
     * @param  Image $image
     * @return bool
     */
    public function checkFilesize($image);

    /**
     * Resize the Image without losing aspect ratio or increasing size
     *
     * @param  string   $type
     * @param  int|null $width
     * @param  int|null $height
     * @return Image
     */
    public function contain($type, $width = null, $height = null);

    /**
     * Checks if the folder path exists. If not, then create it
     *
     * @param  string $path
     * @return string
     */
    public function checkFolderPath($path);

    /**
     * Generate the file path to an image
     *
     * @param  string  $type
     * @param  integer $userid
     * @param  string  $filename
     * @return string
     */
    public function generatePath($type, $userid);

    /**
     * Generate a random filename
     *
     * @return string
     */
    public function generateFilename();
}
