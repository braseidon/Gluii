<?php namespace App\Http\Controllers\Photos;

use App\Http\Requests\Photos\UploadPhotoRequest;
use App\Commands\Photos\UploadPhotoCommand;
use App\Repositories\PhotoRepositoryInterface;
use Auth;
use League\Glide\Server;
use Redirect;
use Str;
use View;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PhotoUploadController extends BaseController
{
    /**
     * The Photo repository
     *
     * @var PhotoRepository
     */
    protected $repository;

    /**
     * Instantiate the Object
     *
     * @param PhotoRepository $repository
     */
    public function __construct(PhotoRepositoryInterface $repository)
    {
        parent::__construct();

        $this->repository = $repository;

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
                Auth::getUser()->id,
                $request->file('image')->getRealPath(),
                true
            )
        );

        if (! $photo) {
            return Redirect::back()->withErrors('Photo', 'Something went wrong.');
        }

        return Redirect::route('user/manage/photos/crop', $photo->id);
    }

    /**
     * Crop the Photo
     *
     * @param  integer  $photoId
     * @return Response
     */
    public function getPhotoCropper($photoId)
    {
        if (! $photo = $this->repository->findPhotoById($photoId)) {
            return Redirect::back()->withErrors('Photo', 'Something went wrong.');
        }

        return View::make('photos.crop-photo', compact('photo'));
    }

    /**
     * Process the cropping of a Photo
     *
     * @param  integer   $photoId
     * @return Response
     */
    public function postPhotoCropperProcess($photoId)
    {
        if (! $photo = $this->repository->findPhotoById($photoId)) {
            return Redirect::back()->withErrors('Photo', 'Something went wrong.');
        }

        return View::make('photos.crop-photo', compact('photo'));
    }
}
