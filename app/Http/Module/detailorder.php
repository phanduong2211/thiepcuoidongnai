<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class detailorder extends Model
	{		
		public $table = "detailorder";
		public $fillable=['id','userID','productID','quantity','color','size','orderid'];
				
	}
 ?>