<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\info;
use Input;
use Session;
use Redirect;
use View;

class InfoController extends Controller
{
	public static function getInfo()
	{
		return info::get();
	}
}

?>