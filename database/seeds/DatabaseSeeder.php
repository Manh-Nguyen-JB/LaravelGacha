<?php

use Illuminate\Database\Seeder;
use App\Models\Gacha, App\Models\Item;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('GachaTableSeeder');
		$this->call('ItemTableSeeder');
	}

}

class GachaTableSeeder extends Seeder {
	public function run()
	{
		$normal_gacha = array(
			'name' => 'Normal Gacha',
			'price' => 100,
			'reset_period' => 60*60,
			'rate_common' => 70,
			'rate_uncommon' => 25,
			'rate_rare' => 4,
			'rate_superrare' => 1
		);

		$expensive_gacha = array(
			'name' => 'Expensive Gacha',
			'price' => 1000,
			'reset_period' => 60*60*24,
			'rate_common' => 10,
			'rate_uncommon' => 50,
			'rate_rare' => 30,
			'rate_superrare' => 10
		);

		Gacha::create($normal_gacha);
		Gacha::create($expensive_gacha);
	}
}

class ItemTableSeeder extends Seeder {
	public function run()
	{
		$card_jobs = array('Wizard', 'Warrior', 'Rogue', 'Paladin', 'Summoner', 
			'Druid', 'Knight', 'Monk', 'Assassin', 'Necromancer');
		$card_races = array('Human','Undead','Orc','Monster', 'Evil', 'Vampire','Dragon', 'Devil', 'Demon', 'Balrog');

		$card_names = array();

		foreach ($card_races as $race) {
			foreach ($card_jobs as $job) {
				$card_names[] = $race . ' The' . $job;
			}
		}

		for ($counter = 0; $counter <= 54; $counter++) {
			Item::create([
				'name' => $card_names[$counter],
				'rarity' => 1
			]);
		}

		for ($counter = 55; $counter <= 79; $counter++) {
			Item::create([
				'name' => $card_names[$counter],
				'rarity' => 2
			]);
		}

		for ($counter = 80; $counter <= 94; $counter++) {
			Item::create([
				'name' => $card_names[$counter],
				'rarity' => 3
			]);
		}

		for ($counter = 95; $counter <= 99; $counter++) {
			Item::create([
				'name' => $card_names[$counter],
				'rarity' => 4
			]);
		}
	}
}
