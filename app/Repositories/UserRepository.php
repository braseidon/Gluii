<?php namespace App\Repositories;

use App\User;

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
    public function listUsers($perPage = 20)
    {
        return User::with('friendcount')
            ->orderBy('id', 'DESC')
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
     * @param  integer $userId
     * @return User
     */
    public function loadUserTimeline($userId)
    {
        $user = User::whereId($userId);

        return $user->with([
                'friendsto',
                'friendsfrom',
                'statuses' => function ($q) {
                    $q->orderBy('updated_at', 'DESC')
                        ->addSelect('id', 'profile_user_id', 'author_id', 'body', 'created_at')
                        ->limit(5);
                },
                'statuses.profileuser' => function ($q) {
                    $q->addSelect('id', 'first_name', 'last_name', 'email');
                },
                'statuses.author' => function ($q) {
                    $q->addSelect('id', 'first_name', 'last_name', 'email');
                },
                'statuses.likes' => function ($q) {
                    $q->addSelect('users.id', 'first_name', 'last_name');
                },
                'statuses.comments' => function ($q) {
                    $q->orderBy('id', 'DESC')
                        ->limit(10);
                },
                'statuses.comments.author' => function ($q) {
                    $q->addSelect('id', 'first_name', 'last_name', 'email');
                },
                'statuses.comments.likes' => function ($q) {
                    $q->addSelect('users.id', 'first_name', 'last_name');
                },
            ])
            ->first();
    }
}
