<?php namespace App\Businesses;

use Auth;

class UserLogic {

	public function __construct(){
		
	}

	public function giveBonusCoin()
	{
		if(Auth::guest())
		{
			return false;
		}

		$user = Auth::user();
		$now = time();
		$given_coin = $now - strtotime($user->last_add_coint_time);

		if($given_coin > 0)
		{
			$user->coin += $given_coin;
			$user->last_add_coint_time = date('Y-m-d H:i:s', $now);
			$user->save();
		}
	}

}