<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class info extends Model
	{		
		public $table = "info";
		public $fillable=['id','name','contents'];
			
	}
 ?>