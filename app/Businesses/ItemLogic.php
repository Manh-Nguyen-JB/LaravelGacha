<?php namespace App\Businesses;

use Auth;
use App\Models\Item, App\Models\ItemUser;

class ItemLogic {

	public function getUserItemList()
	{
		$item_list = Item::all()->toArray();
		$item_user_list = array();
		foreach ($item_list as $item)
		{
			$count = ItemUser::where('item_id', '=', $item['id'])->count();
			if($count > 0)
			{
				$item['number'] = $count;
				$item_user_list[] = $item;
			}
		}
		return $item_user_list;
	}

}