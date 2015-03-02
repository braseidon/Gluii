<?php namespace App\Http\Controllers\Photos;

use App\Http\Requests\Photos\UploadPhotoRequest;
use App\Commands\Photos\UploadPhotoCommand;
use Auth;
use League\Glide\Server;
use Redirect;
use Str;
use View;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PhotoUploadController extends BaseController {

	/**
	 * Instantiate the Object
	 *
	 * @param PhotoRepository $repository
	 */
	public function __construct()
	{
		parent::__construct();

		$user = Auth::getUser()->load('friends');

		View::share('user', $user);
	}

	/**
	 * Upload a new Profile Photo
	 *
	 * @param  integer $userId
	 * @return Response
	 */
	public function getUploadPhoto()
	{
		Auth::getUser()->load('profilepic');

		return View::make('photos.upload-photo');
	}

	/**
	 * Upload a image to crop
	 *
	 * @param  App\Http\Requests\Photos\UploadPhotoRequest $request
	 * @return Response
	 */
	public function postUploadPhoto(UploadPhotoRequest $request)
	{
		// Dispatch the command to upload the photo
		$photo = $this->dispatch(
			new UploadPhotoCommand(
				Auth::getUser()->id, 						// userId
				$request->file('image')->getRealPath(), 	// imagePath
				true										// isProfilePicture
			)
		);

		if(! $photo)
		{
			return Redirect::back()->withErrors('Photo', 'Something went wrong.');
		}

		return View::make('photos.crop-photo');
	}
}