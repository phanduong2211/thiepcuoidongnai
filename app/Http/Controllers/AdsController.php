<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\ads;
use Input;
use Session;
use Redirect;
use View;

class AdsController extends Controller
{
	public static function getAds()
	{
		$ads = new ads();
		return $ads->orderBy('type', 'asc')->get();
	}

	public static function getAdsWhereType($type)
	{
		$ads = new ads();
		return $ads->where('type', '=',$type)->get();
	}
}

?>