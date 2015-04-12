<?php namespace App\Businesses;

use Auth;
use App\Models\Gacha, App\Models\GachaUser;
use App\Models\Item, App\Models\ItemUser;


class GachaLogic {

	protected $probabilities = array(
		'rate_common' => 1, 
		'rate_uncommon' => 2,
		'rate_rare' => 3,
		'rate_superrare' => 4
		);

	public function __construct(){

	}

	public function getAllUserGacha()
	{
		$gacha_list = Gacha::all()->toArray();
		$gacha_user_list = array();
		foreach ($gacha_list as $gacha) {
			$gacha_user = GachaUser::firstOrCreate(array('user_id' => Auth::user()->id, 'gacha_id' => $gacha['id']))->toArray();
			$gacha_user['reset_time'] = strtotime($gacha_user['reset_time']);
			$gacha_user['info'] = $gacha;
			$gacha_user_list[] = $gacha_user;
		}
		return $gacha_user_list;
	}

	public function drawGacha($id){
		$gacha_user = GachaUser::firstOrCreate(array('user_id' => Auth::user()->id, 'gacha_id' => $id))->toArray();
		$gacha_info = Gacha::find($id);

		if($gacha_user['reset_time'] > time()) {
			$result = $gacha_info['name'] + " unable now.";
		}

		if(Auth::user()->coin < $gacha_info['price']) {
			$result = "You do not have enough coin.";
		}

		if(!isset($result)) {
			$number = rand(0,99);
			$rarity = 0; $min = 0;

			foreach ($this->probabilities as $probability => $value) {
				$max = $min + $gacha_info[$probability];
				if($number >= $min && $max >= $number) {
					$rarity = $value;
					break;
				}
				$min = $max;
			}

			$item = Item::where('rarity', '=', $rarity)->orderByRaw('RANDOM()')->first();
			$result = (String) $item;
		}
		return $result;
	}

}