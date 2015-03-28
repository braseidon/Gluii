<?php namespace App\Commands\Photos;

use App\Gluii\ImageMonster\PhotoGuardInterface as ImageMonster;
use App\Repositories\PhotoRepositoryInterface as Repository;
use App\Models\User;
use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class UploadPhotoCommand extends Command implements SelfHandling
{

    /**
     * @var integer $userId The User's ID
     */
    public $userId;

    /**
     * @var string $imagePath The uploaded image's path
     */
    public $imagePath;

    /**
     * @var integer $albumId The User's PhotoAlbum ID
     */
    public $albumId;

    /**
     * @var bool $setProfilePhoto Set true to make Photo the User's new Profile Photo
     */
    public $setProfilePhoto = false;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($userId, $imagePath, $setProfilePhoto = false, $albumId = null)
    {
        $this->userId            = $userId;
        $this->imagePath        = $imagePath;
        $this->albumId            = $albumId;
        $this->setProfilePhoto    = $setProfilePhoto;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle(ImageMonster $imageMonster, Repository $repository)
    {
        // Increase da memory
        ini_set('memory_limit', '128M');

        // Generate the path and filename
        $filename = $imageMonster->generateFilename();
        $path = $imageMonster->generatePath('user', $this->userId);

        // Save image to path
        $image = $imageMonster->process($this->imagePath, $path, $filename);

        // Create row in Photos table & return the model
        $photo = $repository->create([
                'user_id'    => $this->userId,
                'path'        => 'user',
                'filename'    => $filename,
                'filesize'    => $image->filesize()
            ]);

        // Set as profile picture
        if ($this->setProfilePhoto === true) {
            if (! $user = User::find($this->userId)) {
                return false;
            }

            $user->profile_photo_id    = $photo->id;
            $user->profile_photo    = $photo->filename;
            $user->save();
        }

        return $photo;
    }
}
