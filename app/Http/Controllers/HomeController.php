<?php namespace App\Http\Controllers;

use Request;
use Auth;
use App\Businesses\GachaLogic, App\Businesses\ItemLogic;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	protected $gachalogic, $itemlogic; 

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->gachalogic = new GachaLogic;
		$this->itemlogic = new ItemLogic;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$data = array();
		$data['gacha_list'] = $this->gachalogic->getAllUserGacha();
		$tpl = Request::ajax() ? 'home' : 'app';

		return view($tpl, $data);
	}

	public function draw($id)
	{
		return $this->gachalogic->drawGacha($id);
	}

}
