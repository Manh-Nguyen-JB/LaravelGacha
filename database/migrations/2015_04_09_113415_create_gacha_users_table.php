<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGachaUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gacha_users', function(Blueprint $table)
		{
			$table->integer('gacha_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->dateTime('reset_time')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->primary(array('gacha_id', 'user_id'));
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gacha_users');
	}

}
