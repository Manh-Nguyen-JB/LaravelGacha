<?php namespace App\Repositories;

use Auth;

class MyAccountRepository extends BaseRepository{

	/**
	 * Create a new UserRepository instance.
	 *
   	 * @param  App\Models\User $user
	 * @return void
	 */
	public function __construct()
	{
		$this->model = Auth::user();
	}

	public function get()
	{
		return $this->model;
	}

	public function giveBonusCoin()
	{
		$user = $this->model;
		$now = time();
		$given_coin = $now - strtotime($user->last_add_coint_time);
		if($given_coin > 0){
			$user->coin += $given_coin;
			$user->last_add_coint_time = date('Y-m-d H:i:s', $now);
			$user->save();
		}
	}

}