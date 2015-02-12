<?php namespace App\Gluii\User\Traits;

use App\User;

trait NotificationsTrait {

	/**
	 * Cache for Requests Received
	 *
	 * @var Collection
	 */
	protected $requestsPending = null;

	/**
	 * Cache for Requests Sent
	 *
	 * @var Collection
	 */
	protected $requestsSent = null;

	/*
	|--------------------------------------------------------------------------
	| Get Friend Requests
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Get a User's pending received friend requets
	 *
	 * @return Collection
	 */
	public function getRequestsPending()
	{
		if($this->requestsPending !== null)
			return $this->requestsPending;

		$this->requestsPending = $this->friendsfrom()
			->wherePivot('accepted', '=', 0)
			->get(['users.id', 'first_name', 'last_name', 'email']);

		return $this->requestsPending;
	}

	/**
	 * Get a User's pending sent friend requets
	 *
	 * @return Collection
	 */
	public function getRequestsSent()
	{
		if($this->requestsSent !== null)
			return $this->requestsSent;

		$this->requestsSent = $this->friendsto()
			->wherePivot('accepted', '=', 0)
			->get(['users.id', 'first_name', 'last_name', 'email']);

		return $this->requestsSent;
	}
}