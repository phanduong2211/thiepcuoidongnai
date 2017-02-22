<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class order extends Model
	{		
		public $table = "order";
		public $fillable=['id','userID','address','status'];
				
	}
 ?>