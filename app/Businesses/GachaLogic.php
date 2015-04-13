<?php namespace App\Businesses;

use DB;
use Auth;
use App\Models\Item, App\Models\ItemUser;
use App\Models\Gacha, App\Models\GachaUser;


class GachaLogic {

	protected $probabilities = array(
		'rate_common' => 1, 
		'rate_uncommon' => 2,
		'rate_rare' => 3,
		'rate_superrare' => 4
		);

	// public function getAllUserGacha()
	// {
	// 	$gacha_list = Gacha::all()->toArray();
	// 	$gacha_user_list = array();
	// 	foreach ($gacha_list as $gacha) 
	// 	{
	// 		$gacha_user = GachaUser::firstOrCreate(array('user_id' => Auth::user()->id, 'gacha_id' => $gacha['id']))->toArray();
	// 		$gacha_user['info'] = $gacha;
	// 		$reset_timestamp = strtotime($gacha_user['reset_time']);
	// 		$gacha_user['formated_reset_time'] = date('d M Y h:i A' , $reset_timestamp);
	// 		$gacha_user['countdown'] = $reset_timestamp - time();
	// 		$gacha_user_list[] = $gacha_user;
	// 	}
	// 	return $gacha_user_list;
	// }

	public function getAllGacha()
	{
		return Gacha::all()->toArray();
	}

	public function getUserGacha($id)
	{
		$gacha = Gacha::find($id)->toArray();
		$gacha_user = GachaUser::firstOrCreate(array('user_id' => Auth::user()->id, 'gacha_id' => $gacha['id']))->toArray();
		$reset_timestamp = strtotime($gacha_user['reset_time']);
		$gacha_user['formated_reset_time'] = date('d M Y h:i A' , $reset_timestamp);
		$gacha_user['countdown'] = $reset_timestamp - time();
		$gacha_user['info'] = $gacha;
		return $gacha_user;
	}

	public function drawGacha($id) 
	{
		$gacha_user = GachaUser::firstOrCreate(array('user_id' => Auth::user()->id, 'gacha_id' => $id));
		$gacha_info = Gacha::find($id);

		$pay_flag = $gacha_user->reset_time > time();

		if($pay_flag && Auth::user()->coin < $gacha_info->price)
		{
			return "You do not have enough coin.";
		}

		$number = rand(0,99);
		$rarity = 0; $min = 0;

		foreach ($this->probabilities as $probability => $value)
		{
			$max = $min + $gacha_info[$probability];
			if($number >= $min && $max >= $number)
			{
				$rarity = $value;
				break;
			}
			$min = $max;
		}

		$gacha = array();
		$gacha['user'] = $gacha_user;
		$gacha['info'] = $gacha_info;

		$item = $this->drawTransaction($rarity, $pay_flag, $gacha);
		return $item;
	}

	public function drawTransaction($rarity, $pay_flag, $gacha)
	{
		$user_id = Auth::user()->id;
		$user_coin = Auth::user()->coin;

		$gacha_user = $gacha['user'];
		$gacha_info = $gacha['info'];

		$item = Item::where('rarity', '=', $rarity)->orderByRaw('RANDOM()')->first();
		$result = $item->toArray();
		$now = time();

		DB::beginTransaction();
		try {		
			if($pay_flag){
				$new_user_coin = $user_coin - $gacha_info->price;
				DB::update('update users set coin = ? where id = ?', array($new_user_coin, $user_id));
			}else{
				$reset_time = date('Y-m-d H:i:s', $now + $gacha_info->reset_period);
				DB::update('update gacha_users set reset_time = ? where gacha_id = ? and user_id = ?', 
					array($reset_time, $gacha_info->id, $user_id));
			}
			$now = date('Y-m-d H:i:s', $now);
			DB::insert('insert into item_users (item_id, user_id, created_at, updated_at) values (?, ?, ?, ?)', 
				array($item->id, $user_id, $now, $now));
			DB::commit();
		} catch (Exception $e) {
			$result = FALSE;
			DB::rollback();
		}

		return $result;
	}

}