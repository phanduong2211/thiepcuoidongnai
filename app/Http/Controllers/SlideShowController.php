<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\slideshow;
use Input;
use Session;
use Redirect;
use View;

class SlideShowController extends Controller
{
	public static function getSlideShow($page)
	{
		$slideshow = new slideshow();
		return $slideshow->where('page', '=',$page)->get();
	}
}

?>