<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\page;
use Input;
use Session;
use Redirect;
use View;

class PageController extends Controller
{
	public static function getPage()
	{
		return page::get();
	}
	public static function getPageWhereUrl($url)
	{
		return page::where("url","=",$url)->get();
	}
}

?>