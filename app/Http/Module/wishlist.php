<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class wishlist extends Model
	{		
		public $table = "wishlist";
		public $fillable=['userID','productID'];
		public static function getwishlistWhereUserIDandProductID($userID,$productID)
		{
			return DB::table('wishlist')->where('userID','=',$userID)->where('productID','=',$productID)->get();
		}		
	}
 ?>