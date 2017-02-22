<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\menu;
use Input;
use Session;
use Redirect;
use View;

class MenuController extends Controller
{
	public static function getMenu()
	{
		$menu = new menu();
		return $menu->orderBy('root', 'asc')->get();
	}
}

?>