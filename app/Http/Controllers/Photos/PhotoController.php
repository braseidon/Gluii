<?php namespace App\Http\Controllers\Photos;

use App\Repositories\PhotoRepositoryInterface;
use Auth;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PhotoController extends BaseController
{

    /**
     * Photo Repository
     *
     * @var PhotoRepository $repository
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
    }

    /**
     * View a Photo
     *
     * @param  int       $id
     * @return Response
     */
    public function getViewPhoto($photoId)
    {
        if (! $photo = $this->repository->findPhotoById($photoId)) {
            return false;
        }

        // if (! $photo) {
        //     return redirect()->route('home')->withErrors(['Photo Error' => 'Photo not found!']);
        // }

        $content = view('photos.modals.photo', compact('photo'));

        return $content;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getViewPhotos($userId)
    {
        $user = $this->repository->loadPhotos($userId);

        if (! $user) {
            return redirect()->route('home')->withErrors(['Photo Error' => 'Photo not found!']);
        }

        return view()->make('profile.photos', compact('user'));
    }

    /**
     * Like a Photo
     *
     * @param  \App\Http\Requests\Photo\LikePhotoRequest $request
     * @return Response
     */
    public function postLikePhoto(\App\Http\Requests\Photo\LikePhotoRequest $request)
    {
        $this->dispatch(
            new LikePhotoCommand(
                Auth::getUser()->id,
                $request->input('photo_id')
            )
        );

        if (! $request->ajax()) {
            return redirect()->back();
        }
    }

    /**
     * Unlike a Photo
     *
     * @param  \App\Http\Requests\Photo\LikePhotoRequest $request
     * @return Response
     */
    public function postUnlikePhoto(\App\Http\Requests\Photo\LikePhotoRequest $request)
    {
        $this->repository->unlikePhoto(Auth::getUser(), $request->input('photo_id'));

        if (! $request->ajax()) {
            return redirect()->back();
        }
    }
}
