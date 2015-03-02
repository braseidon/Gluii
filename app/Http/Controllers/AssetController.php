<?php namespace App\Http\Controllers;

use App;
use Config;
use League\Glide\Server;

use Illuminate\Http\Request;

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
	public function getUserPhoto(Request $request, $size, $path)
	{
		if(! $arr = Config::get('photos.templates.' . $size, false))
			App::abort(404);

		return $this->server->outputImage($path, $arr);
	}

}
