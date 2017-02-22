<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\detailproduct;
use Input;
use Session;
use Redirect;
use View;

class DetailProductController extends Controller
{
	public static function getDetailProduct($productID)
	{
		$detailproduct = new detailproduct();
		return $detailproduct->where('productID', '=',$productID)->get();
	}
}

?>