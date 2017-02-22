<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\product;
use Input;
use Session;
use Redirect;
use View;

class ProductController extends Controller
{
	public static function getProduct()
	{
		return product::where("display","=",1)->where("bin","=",0)->orderBy('id', 'desc')->paginate(16);
	}

	public static function getProductWhereID($id)
	{
		$product = new product();
		return $product->where('id','=',$id)->get();
	}

	public static function getProductWhereStatus($status)
	{
		return product::where("display","=",1)->where("bin","=",0)->where('status','=',$status)->get();
	}
	public static function getProductWhereCategoryID($categoryID,$id)
	{		
		return product::where("display","=",1)->where("bin","=",0)->where('categoryID','=',$categoryID)->where('id','!=',$id)->take(12)->get();
	}
	public static function getAllProductWhereCategoryID($categoryID)
	{		
		return product::where("display","=",1)->where("bin","=",0)->where('categoryID','=',$categoryID)->paginate(16);
	}
	public static function getAllProductWhereTagID($ID)
	{		
		return product::where("display","=",1)->where("bin","=",0)->where('TagID','=',$ID)->paginate(16);
	}
	public static function getAllProductWhereMenuID($ID)
	{		
		return product::where("display","=",1)->where("bin","=",0)->where('menuID','=',$ID)->paginate(16);
	}
	public static function update($data,$id)
	{
		$product =new product();
		return $product->updateProduct($data,$id);
	}
	public static function getProductWhereName($name)
	{
		return product::where("display","=",1)->where("bin","=",0)->where("name","like","%".$name."%")->paginate(16);
	}
	public static function getProductWhereNameAndCate($name,$categoryID)
	{
		return product::where("display","=",1)->where("bin","=",0)->where("categoryID","=",$categoryID)->where("name","like","%".$name."%")->paginate(16);
	}
	public static function getproductMaxView()
	{
		return product::where("display","=",1)->where("bin","=",0)->orderBy('view','desc')->take(5)->get();
	}
}

?>