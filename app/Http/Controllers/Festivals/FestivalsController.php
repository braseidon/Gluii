<?php namespace App\Http\Controllers\Festivals;

use App\Http\Requests;
use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;

use DB;
use App\User;

class FestivalsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		// $first = DB::table('users')->whereNull('first_name');

		// $users = DB::table('users')->whereNull('last_name')->union($first)->get();

		// $user = User::->getModel();

		$user = User::with('friendsto','friendsfrom')->find(1);

		$friendsfrom = $user->friendsfrom;
		$friends = $user->friendsto->merge($friendsfrom);
		$user->setRelation('friends', $friends);
		dd($user);
	}

	public function queryWithCounting()
	{
		$user = User::with([
			'friendsto' => function($q) {
				// The post_id foreign key is needed,
				// so Eloquent could rearrange the relationship between them
				$q->select( [DB::raw("count(*) as friendsto_count"), "friend_id"] )
					->groupBy("friend_id");
				},
			'friendsfrom' => function($q) {
				// The post_id foreign key is needed,
				// so Eloquent could rearrange the relationship between them
				$q->select( [DB::raw("count(*) as friendsfrom_count"), "user_id"] )
					->groupBy("user_id");
				}
			])
			->find(1);
	}

}
