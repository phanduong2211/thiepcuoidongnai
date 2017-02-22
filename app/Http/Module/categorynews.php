<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class categorynews extends Model
	{		
		public $table = "categorynews";
		public $fillable=['name'];		
	}
 ?>