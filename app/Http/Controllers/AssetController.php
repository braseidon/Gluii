<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Glide\Server;

class AssetController extends BaseController {

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
	public function getUserPhoto($path)
	{
		// Set source image path prefix
		$this->server->setSourcePathPrefix('images/covers');

		$arr = [
			'w'		=> Config::get('photos.limits.width'),
			'h'		=> Config::get('photos.limits.height'),
			'fit'	=> 'max'
		]

		return $this->server->outputImage($path, $arr);
	}

}
