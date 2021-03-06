<?php namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    /*
    |--------------------------------------------------------------------------
    | Queries
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Retrieve all users from the database
     *
     * @return Collection
     */
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  integer  $identifier
     * @return Model|null
     */
    public function findById($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Fetch a user by their username.
     *
     * @param $username
     * @return mixed
     */
    public function findByUsername($username)
    {
        return User::with('statuses')->where('username', $username)->first();
    }

    /**
     * Fetch a user by their email.
     *
     * @param $email
     * @return mixed
     */
    public function findByEmail($email)
    {
        return User::with('statuses')->where('email', $email)->first();
    }

    /**
     * Create or update a user based on its unique identifier
     *
     * @param  integer|null $id
     * @return Model
     */
    public function createOrUpdate($id = null)
    {
        return User::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'id' => $id
            ]
        );
    }

    /**
     * Returns a User list, paginated
     *
     * @param  integer $perPage
     * @return Collection
     */
    public function listUsers($perPage = 30)
    {
        return User::with('friendcount')
            ->orderBy('id', 'ASC')
            ->paginate($perPage);
    }

    /*
    |--------------------------------------------------------------------------
    | Friend Request Actions
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Send a friend request
     *
     * @param integer $userId
     * @return void
     */
    public function addFriend($userId, User $user)
    {
        return $user->friendsto()->attach($userId, ['accepted' => false]);
    }

    /**
     * Cancel a friend request
     *
     * @param  integer $userId
     * @return void
     */
    public function removeFriend($userId, User $user)
    {
        $user->friendsto()->detach($userId);
        $user->friendsfrom()->detach($userId);
    }

    /**
     * Accepts a friend request
     *
     * @param  integer $userId
     * @return Builder
     */
    public function acceptRequest($userId, User $user)
    {
        $user->friendsfrom()->updateExistingPivot($userId, ['accepted' => true]);
        $user->friendsto()->attach($userId, ['accepted' => true]);
    }

    /**
     * Deny a friend request
     *
     * @param  integer $userId
     * @return void
     */
    public function denyRequest($userId, User $user)
    {
        $friend = User::find($userId);
        $friend->friendsto()->detach($user->id);
    }

    /*
    |--------------------------------------------------------------------------
    | User Profile Loading
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Get User's profile for viewing
     *
     * @param  string $username
     * @return User
     */
    public function loadUserTimeline($username)
    {
        if (is_numeric($username)) {
            $user = User::where('id', $username);
        } else {
            $user = User::where('username', $username);
        }

        return $user->loadProfile()->first();
    }
}
