<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Glide\Server;

class ImageController extends Controller {

	/**
	 * The Glide\Server implementation
	 *
	 * @var League\Glide\Server $server
	 */
	protected $server;

	/**
	 * Instantiate the Object
	 *
	 * @param Server $server
	 */
	public function __construct(Server $server)
	{
		parent::__construct();

		$this->server = $server;
	}

	/**
	 * Output Cover Photos
	 *
	 * @param  string $path
	 * @return Image
	 */
	public function getCoverPhoto($path)
	{
		// Set source image path prefix
		$this->server->setSourcePathPrefix('images/covers');

		return $this->server->outputImage($path);
	}

}
