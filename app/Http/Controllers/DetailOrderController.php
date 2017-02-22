<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\detailorder;
use Input;
use Session;
use Redirect;
use View;

class DetailOrderController extends Controller
{
	public static function getDetailOrder()
	{
		return detailorder::orderBy('id', 'desc')->get();
	}
	
	public static function insert($data)
	{		
			$detailorder =new detailorder();
			$detailorder->fill($data);
			$detailorder->save();			
	}
}

?>