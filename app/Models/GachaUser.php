<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GachaUser extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'gacha_users';
	protected $fillable = array('user_id', 'gacha_id');
}
