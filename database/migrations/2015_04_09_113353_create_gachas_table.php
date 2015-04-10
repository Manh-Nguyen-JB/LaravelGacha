<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGachasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gachas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('price')->unsigned();
			$table->integer('reset_period')->unsigned();
			$table->integer('rate_common')->unsigned();
			$table->integer('rate_uncommon')->unsigned();
			$table->integer('rate_rare')->unsigned();
			$table->integer('rate_superrare')->unsigned();
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
		Schema::drop('gachas');
	}

}
