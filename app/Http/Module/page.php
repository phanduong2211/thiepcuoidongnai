<?php 
	/**
	* 
	*/
	namespace App\Http\Module;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Session;
	class page extends Model
	{		
		public $table = "page";
		public $fillable=['name','content','view','url','menuid'];		
	}
 ?>