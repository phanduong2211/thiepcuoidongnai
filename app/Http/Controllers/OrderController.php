<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\order;
use Input;
use Session;
use Redirect;
use View;

class OrderController extends Controller
{
	public static function getOrder()
	{
		return order::orderBy('id', 'desc')->get();
	}
	
	public static function insert($data)
	{		
			$order =new order();
			$order->fill($data);
			$order->save();

			return $order->id;			
	}
}

?>