<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class category extends Model
	{		
		public $table = "category";
		public $fillable=['name'];		
	}
 ?>