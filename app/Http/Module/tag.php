<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class tag extends Model
	{		
		public $table = "tag";
		public $fillable=['name'];		
	}
 ?>