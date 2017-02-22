<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Module\wishlist;
use Input;
use Session;
use Redirect;
use View;

class WishlistController extends Controller
{
	public static function getWishlist()
	{
		$wishlist = new wishlist();
		return $wishlist->orderBy('id', 'desc')->get();
	}
	public static function getWishlistWhereUserID($id)
	{
		$wishlist = new wishlist();
		return $wishlist->where('userID','=',$id)->orderBy('id', 'desc')->get();
	}
	public static function deletewishlist($id)
	{
		//$wishlist = new wishlist();
		$wishlist=wishlist::find($id);
		$wishlist->delete();
	}
	public static function insertwishlist($userID,$productID)
	{
		$data = array("userID"=>$userID,"productID"=>$productID);
		$wishlist = wishlist::getwishlistWhereUserIDandProductID($userID,$productID);
		if(count($wishlist)==0)
		{
			$wishlist =new wishlist();
			$wishlist->fill($data);
			$wishlist->save();
			return 1;
		}
		else
		{
			return 0;
		}
		
	}
}

?>