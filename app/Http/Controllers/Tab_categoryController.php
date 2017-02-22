<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\tab_category;
use Input;
use Session;
use Redirect;
use View;

class Tab_categoryController extends Controller
{
	public static function getTab_category()
	{
		$tab_category = new tab_category();
		return $tab_category->orderBy('id', 'desc')->get();
	}
}

?>