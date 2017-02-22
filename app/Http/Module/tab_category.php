<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class tab_category extends Model
	{		
		public $table = "tab_category";
		public $fillable=['name'];		
	}
 ?>